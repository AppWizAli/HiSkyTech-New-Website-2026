<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include "config/db.php";
$schemas = include "schemas/schemas.php";

/* -------------------- GET TABLE AND RECORD -------------------- */
$table = $_GET['table'] ?? null;
$id    = (int)($_GET['id'] ?? 0);

if (!$table || !isset($schemas[$table])) die("Invalid table.");

$schema = $schemas[$table];
$fields = $schema['fields'];
$primaryKey = $schema['primary_key'] ?? 'id';

/* -------------------- FETCH EXISTING RECORD -------------------- */
$result = mysqli_query($conn, "SELECT * FROM `$table` WHERE `$primaryKey`=$id");
if (!$result || mysqli_num_rows($result) == 0) die("Record not found.");
$data = mysqli_fetch_assoc($result);

/* -------------------- HELPER: SLUG GENERATOR -------------------- */
function makeSlug($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    return trim($slug, '-');
}

/* -------------------- HANDLE POST -------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $updates = [];

    foreach ($fields as $field => $config) {
        if (is_string($config)) $config = ['type'=>$config];
        $type = $config['type'];

        /* ----------- FILE / IMAGE HANDLING ----------- */
        if (($type === 'file' || $type === 'image') && isset($_FILES[$field]) && $_FILES[$field]['error'] != 4) {
            $uploadDir = $config['upload_dir'] ?? 'uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = time() . "_" . basename($_FILES[$field]['name']);
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $uploadDir . $filename)) {

                // Delete old file
                if (!empty($data[$field])) {
                    $oldFiles = json_decode($data[$field], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($oldFiles)) {
                        foreach ($oldFiles as $f) {
                            if (file_exists($uploadDir . $f)) unlink($uploadDir . $f);
                        }
                    } else {
                        if (file_exists($uploadDir . $data[$field])) unlink($uploadDir . $data[$field]);
                    }
                }

                $updates[] = "$field='" . mysqli_real_escape_string($conn, $filename) . "'";
            }
        }

        /* ----------- NORMAL INPUT ----------- */
        elseif (isset($_POST[$field]) && ($type !== 'slug')) {
            $updates[] = "$field='" . mysqli_real_escape_string($conn, $_POST[$field]) . "'";
        }
    }

    /* -------------------- HANDLE SLUG -------------------- */
    foreach ($fields as $field => $config) {
        if (is_string($config)) $config = ['type'=>$config];
        if (($config['type'] ?? '') === 'slug') {

            $slugField = $field;
            $sourceField = $config['source'] ?? array_key_first($fields);
            $slugValue = trim($_POST[$slugField] ?? '');

            if (empty($slugValue) && !empty($_POST[$sourceField])) {
                $slug = makeSlug($_POST[$sourceField]);
                $i = 1;
                $baseSlug = $slug;

                do {
                    $check = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM `$table` WHERE `$slugField`='" . mysqli_real_escape_string($conn, $slug) . "' AND `$primaryKey` != $id");
                    $row = mysqli_fetch_assoc($check);
                    if ($row['cnt'] > 0) $slug = $baseSlug . '-' . $i++;
                } while($row['cnt'] > 0);

            } elseif (!empty($slugValue)) $slug = $slugValue;
            else $slug = 'item-' . time();

            $updates[] = "$slugField='" . mysqli_real_escape_string($conn, $slug) . "'";
        }
    }

    /* -------------------- UPDATE DATABASE -------------------- */
    if (!empty($updates)) {
        $sql = "UPDATE `$table` SET " . implode(',', $updates) . " WHERE `$primaryKey`=$id";
        if (!mysqli_query($conn, $sql)) {
            $error = mysqli_error($conn);
        }
    }

    header("Location: show.php?table=$table");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Edit <?= ucfirst($table) ?></title>
<?php include 'partials/css.php'; ?>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
</head>
<body>
<div class="overlay" id="overlay"></div>
<?php include 'partials/preloader.php'; ?>
<div class="app">
    <?php include 'partials/sidebar.php'; ?>
    <div class="main">
        <?php include 'partials/head.php'; ?>
        <div class="container-fluid p-0 top-container">

<header class="form-header mt-3">
  <div class="header-content">
    <i class="fas fa-user-edit header-icon"></i>
    <div>
      <h1 class="header-title">Edit <?= ucfirst($table) ?></h1>
      <p class="header-subtitle">Update the details below</p>
    </div>
  </div>
  <a href="show.php?table=<?= $table ?>" class="btn-outline header-btn">
      <i class="fas fa-arrow-left"></i> Back
  </a>
</header>

<form class="themed-form compact-form mt-3" method="POST" enctype="multipart/form-data" novalidate>

<?php foreach ($fields as $field => $config): ?>
    <?php if (is_string($config)) $config = ['type'=>$config, 'label'=>ucwords(str_replace('_',' ',$field))]; ?>
    <?php $type = $config['type']; ?>
    <div class="form-row mb-3">

        <!-- Textarea / Editor -->
        <?php if ($type === 'textarea' || $type === 'editor'): ?>
            <div class="input-group">
                <textarea id="<?= $field ?>" name="<?= $field ?>" rows="12"><?= htmlspecialchars($data[$field]) ?></textarea>
                <label for="<?= $field ?>"><?= $config['label'] ?></label>
            </div>

<!-- File/Image -->
<?php elseif (in_array($type,['file','image'])): ?>
    <div class="input-group">
        <?php if (!empty($data[$field])): ?>
            <?php
            $files = json_decode($data[$field], true);
            if (json_last_error() !== JSON_ERROR_NONE) $files = [$data[$field]];
            foreach ($files as $f):
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext,['mp4','webm','ogg'])): ?>
                    <video src="uploads/<?= htmlspecialchars($f) ?>" controls style="max-width:200px; margin-bottom:5px;"></video>
                <?php else: ?>
                    <img src="uploads/<?= htmlspecialchars($f) ?>" alt="Current File" style="height:80px; object-fit:cover; border-radius:4px; margin-bottom:5px;">
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Allow both images and videos -->
        <input type="file" name="<?= $field ?>" id="<?= $field ?>" accept="image/*,video/*"/>
        <label for="<?= $field ?>"><?= $config['label'] ?></label>
    </div>

<!-- Normal input -->
<?php else: ?>

            <div class="input-group">
                <input type="<?= $type ?>"
                       id="<?= $field ?>"
                       name="<?= $field ?>"
                       value="<?= htmlspecialchars($data[$field]) ?>"
                       <?= !empty($config['required']) ? 'required' : '' ?> />
                <label for="<?= $field ?>"><?= $config['label'] ?></label>
            </div>
        <?php endif; ?>

    </div>
<?php endforeach; ?>

<div class="form-row submit-row mt-3">
    <button type="submit" class="btn-primary">Update</button>
</div>
</form>

</div>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(){
    <?php foreach($fields as $field => $config): ?>
        <?php if(is_string($config)) $config = ['type'=>$config]; ?>
        <?php if($config['type'] === 'editor'): ?>
            if(document.getElementById('<?= $field ?>')){
                ClassicEditor.create(document.querySelector('#<?= $field ?>'), {
                    toolbar:['heading','|','bold','italic','underline','link','bulletedList','numberedList','|','blockQuote','insertTable','undo','redo'],
                    placeholder:'Write content here...'
                }).catch(error=>console.error(error));
            }
        <?php endif; ?>
    <?php endforeach; ?>
});
</script>

<?php include 'partials/js.php'; ?>
</body>
</html>
