<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include "config/db.php";
$schemas = include "schemas/schemas.php";

/* -------------------- GET TABLE -------------------- */
$table = $_GET['table'] ?? null;
if (!$table || !isset($schemas[$table])) {
    die("Invalid table.");
}

$schema = $schemas[$table];
$fields = $schema['fields'];

/* -------------------- CHILD TABLE CHECK -------------------- */
$childTables = ['mobile_develop','app_experties','our_feature','our_stack'];
$isChildTable = in_array($table, $childTables);

$serviceId = $_GET['service_id'] ?? '';
if ($isChildTable && !$serviceId) {
    die("Service ID is required for this table. Open via Manage Service link.");
}

/* -------------------- HELPER: SLUG GENERATOR -------------------- */
function makeSlug($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

/* -------------------- HANDLE POST -------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $cols = [];
    $vals = [];

    foreach ($fields as $field => $config) {
        if (is_string($config)) $config = ['type' => $config];
        $type = $config['type'];

        // Skip slug & service_id (handled manually)
        if ($type === 'slug' || ($isChildTable && $field === 'service_id')) continue;

        // ----------- FILE / IMAGE / VIDEO UPLOAD ----------
        if (($type === 'file' || $type === 'image' || $type === 'video') 
            && isset($_FILES[$field]) && $_FILES[$field]['error'] != 4) {

            $uploadDir = $config['upload_dir'] ?? 'uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = time() . "_" . basename($_FILES[$field]['name']);
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $uploadDir . $filename)) {

                if ($type === 'video') {
                    $vals[] = "'" . mysqli_real_escape_string($conn, json_encode([$filename])) . "'";
                } else {
                    $vals[] = "'" . mysqli_real_escape_string($conn, $filename) . "'";
                }
                $cols[] = $field;
            }

        // ----------- NORMAL INPUT ----------
        } elseif (isset($_POST[$field])) {
            $cols[] = $field;
            $vals[] = "'" . mysqli_real_escape_string($conn, $_POST[$field]) . "'";
        }
    }

    /* ------------------- AUTO-GENERATE SLUG ------------------- */
    foreach ($fields as $field => $config) {
        if (is_string($config)) $config = ['type' => $config];
        if (($config['type'] ?? '') === 'slug') {
            $slugField = $field;
            $sourceField = $config['source'] ?? array_key_first($fields);
            $slugValue = trim($_POST[$slugField] ?? '');

            if (empty($slugValue) && !empty($_POST[$sourceField])) {
                $slug = makeSlug($_POST[$sourceField]);
                $i = 1;
                $baseSlug = $slug;
                do {
                    $check = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM `$table` WHERE `$slugField`='" . mysqli_real_escape_string($conn, $slug) . "'");
                    $row = mysqli_fetch_assoc($check);
                    if ($row['cnt'] > 0) {
                        $slug = $baseSlug . '-' . $i;
                        $i++;
                    }
                } while ($row['cnt'] > 0);
            } elseif (!empty($slugValue)) {
                $slug = $slugValue;
            } else {
                $slug = 'item-' . time();
            }

            $cols[] = $slugField;
            $vals[] = "'" . mysqli_real_escape_string($conn, $slug) . "'";
        }
    }

    /* ------------------- ADD SERVICE ID IF CHILD TABLE ------------------- */
    if ($isChildTable && $serviceId) {
        $cols[] = 'service_id';
        $vals[] = "'" . mysqli_real_escape_string($conn, $serviceId) . "'";
    }

    /* ------------------- INSERT INTO DATABASE ------------------- */
    if (!empty($cols)) {
        $sql = "INSERT INTO `$table` (" . implode(",", $cols) . ") VALUES (" . implode(",", $vals) . ")";
        if (mysqli_query($conn, $sql)) {
            $redirect = "show.php?table=$table";
            if ($isChildTable) $redirect .= "&service_id=" . $serviceId;
            header("Location: $redirect");
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add <?= ucfirst($table) ?></title>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<?php include 'partials/css.php'; ?>
</head>

<body>
<div class="overlay" id="overlay"></div>
<div class="app">
    <?php include 'partials/sidebar.php'; ?>
    <div class="main">
        <?php include 'partials/head.php'; ?>

        <div class="container-fluid p-0 top-container">

            <header class="form-header mt-3">
                <div class="header-content">
                    <i class="fas fa-plus header-icon"></i>
                    <div>
                        <h1 class="header-title">Add New <?= ucfirst($table) ?></h1>
                        <p class="header-subtitle">Fill in the details below to add a new record</p>
                    </div>
                </div>

                <a href="show.php?table=<?= $table ?><?= $isChildTable ? '&service_id=' . $serviceId : '' ?>" class="btn-outline header-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </header>

            <form class="themed-form compact-form" method="POST" enctype="multipart/form-data" novalidate>

                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <?php foreach($fields as $field => $config):
                    if(is_string($config)) $config = ['type'=>$config,'label'=>ucwords(str_replace('_',' ',$field))];
                    $type = $config['type'];
                    if($isChildTable && $field==='service_id') continue; // handled manually
                ?>
                    <div class="form-row">

                        <?php if($type==='textarea'): ?>
                            <div class="input-group">
                                <textarea id="<?= $field ?>" name="<?= $field ?>" rows="4"><?= htmlspecialchars($_POST[$field] ?? '') ?></textarea>
                                <label for="<?= $field ?>"><?= $config['label'] ?></label>
                            </div>

                        <?php elseif($type==='editor'): ?>
                            <div class="input-group">
                                <textarea id="<?= $field ?>" name="<?= $field ?>" rows="12"><?= htmlspecialchars($_POST[$field] ?? '') ?></textarea>
                                <label for="<?= $field ?>"><?= $config['label'] ?></label>
                            </div>

                        <?php elseif($type==='file' || $type==='image' || $type==='video'): ?>
                            <div class="input-group">
                                <input type="file" id="<?= $field ?>" name="<?= $field ?>" accept="image/*,video/*">
                                <label for="<?= $field ?>"><?= $config['label'] ?></label>
                            </div>

                        <?php elseif($type==='select'): ?>
                            <div class="input-group">
                                <select id="<?= $field ?>" name="<?= $field ?>">
                                    <?php foreach($config['options'] as $k=>$v): ?>
                                        <option value="<?= $k ?>" <?= (($_POST[$field]??$config['default'])==$k)?'selected':'' ?>><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="<?= $field ?>"><?= $config['label'] ?></label>
                            </div>

                        <?php else: ?>
                            <div class="input-group">
                                <input type="<?= $type ?>" id="<?= $field ?>" name="<?= $field ?>" value="<?= htmlspecialchars($_POST[$field] ?? '') ?>" <?= !empty($config['required'])?'required':'' ?>>
                                <label for="<?= $field ?>"><?= $config['label'] ?></label>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>

                <div class="form-row submit-row">
                    <button type="submit" class="btn-primary">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include 'partials/js.php'; ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editors = document.querySelectorAll("textarea[id$='_content']");
    editors.forEach(el => {
        ClassicEditor.create(el, {
            toolbar: [
                'heading','|','bold','italic','underline',
                'link','bulletedList','numberedList','|',
                'blockQuote','insertTable','undo','redo'
            ],
            placeholder: 'Write your content here...'
        }).catch(error => console.error(error));
    });
});
</script>
</body>
</html>