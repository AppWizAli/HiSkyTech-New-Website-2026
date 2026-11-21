<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include "config/db.php";
$schemas = include "schemas/schemas.php";

$table = $_GET['table'] ?? die("Table not specified");
$id    = (int)($_GET['id'] ?? 0);

if (!isset($schemas[$table])) die("Invalid table");

$schema = $schemas[$table];
$fields = $schema['fields'];
$primaryKey = $schema['primary_key'] ?? 'id';

// ===== CHILD TABLE SERVICE FILTER =====
$childTables = ['mobile_develop','app_experties','our_feature','our_stack'];
$isChildTable = in_array($table, $childTables);
$serviceId = $_GET['service_id'] ?? '';
$whereService = '';
if ($isChildTable && $serviceId) {
    $whereService = "WHERE service_id='".mysqli_real_escape_string($conn,$serviceId)."'";
}

// ===== ENTRIES PER PAGE =====
$perPageOptions = [4,5,10,20];
$perPage = isset($_GET['perPage']) && in_array((int)$_GET['perPage'],$perPageOptions) ? (int)$_GET['perPage'] : 4;
$page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
$start = ($page-1)*$perPage;

// ===== SEARCH FILTER =====
$searchSQL = '';
$searchVal = '';
if(isset($_GET['search']) && $_GET['search']!=='') {
    $searchVal = mysqli_real_escape_string($conn,$_GET['search']);
    $whereArr = [];
    foreach($fields as $field=>$type) $whereArr[] = "$field LIKE '%$searchVal%'";
    $searchSQL = "WHERE ".implode(" OR ",$whereArr);

    if ($whereService) $searchSQL .= " AND " . substr($whereService,6); // append service filter
} else if ($whereService) {
    $searchSQL = $whereService;
}

// ===== CONTACT_MESSAGES DEFAULT UNREAD & FILTER =====
if($table=='contact_messages') {
    $filter = $_GET['filter'] ?? 'unread';
    if(!in_array($filter,['read','unread'])) $filter='unread';

    if($searchSQL) $searchSQL .= " AND status='$filter'";
    else $searchSQL = "WHERE status='$filter'";
}

// ===== TOTAL RECORDS =====
$totalRes = mysqli_query($conn,"SELECT COUNT(*) as total FROM {$schema['table']} $searchSQL");
$totalRow = mysqli_fetch_assoc($totalRes);
$totalRecords = $totalRow['total'];
$totalPages = max(1, ceil($totalRecords/$perPage));

// ===== FETCH RECORDS =====
$result = mysqli_query($conn,"SELECT * FROM {$schema['table']} $searchSQL ORDER BY $primaryKey DESC LIMIT $start,$perPage");

// ===== SERVICES FOR DROPDOWN =====
$services = [];
if($isChildTable) {
    $resServices = mysqli_query($conn,"SELECT id, service_title FROM services ORDER BY id ASC");
    while($s = mysqli_fetch_assoc($resServices)) $services[] = $s;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Admin Panel — <?= ucfirst($table) ?> Dashboard</title>
<?php include 'partials/css.php'; ?>
<style>
/* Table helper tweaks — colors/layout inherited from index.css .table-responsive rules */
.custom-table-responsive {overflow-x:auto; -webkit-overflow-scrolling:touch;}
.custom-table {min-width:1100px; border-collapse:collapse;}
.custom-table th, .custom-table td {vertical-align:middle;}
.table-thumb {height:50px; width:auto; object-fit:cover; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.12); display:block;}
.truncate-text {max-width:220px; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; white-space:normal; text-overflow:ellipsis; line-height:1.4;}
.table-actions {white-space:nowrap;}
#serviceSelect {max-width:340px;}
</style>
</head>
<body>

<div class="overlay" id="overlay"></div>
<?php include 'partials/preloader.php'; ?>

<div class="app">
    <?php include 'partials/sidebar.php'; ?>
    <div class="main">
        <?php include 'partials/head.php'; ?>

        <div class="container-fluid top-container">
            <div class="row g-4">
<div class="col-12">
<header class="dashboard-header mt-5">
  <div class="header-content">
    <i class="fas fa-chart-line header-icon"></i>
    <div>
      <h1 class="header-title"><?= ucfirst($table) ?> Dashboard</h1>
      <p class="header-subtitle">Manage <?= ucfirst($table) ?> records</p>
    </div>
  </div>

  <?php if (!in_array($table,['contact_messages','admin'])): ?>
    <button class="btn-accent header-btn" onclick="window.location.href='add.php?table=<?= $table ?><?= $isChildTable && $serviceId?'&service_id='.$serviceId:'' ?>'">
        <i class="fas fa-plus"></i> Add <?= ucfirst($table) ?>
    </button>
  <?php endif; ?>
</header>

<?php if($isChildTable && $services): ?>
<select id="serviceSelect" class="form-select mb-3">
    <option value="">-- Select Service --</option>
    <?php foreach($services as $s): ?>
        <option value="<?= $s['id'] ?>" <?= $s['id']==$serviceId?'selected':'' ?>><?= htmlspecialchars($s['service_title']) ?></option>
    <?php endforeach; ?>
</select>
<script>
document.getElementById('serviceSelect').addEventListener('change', function(){
    const sid = this.value;
    let url = '?table=<?= $table ?>';
    if(sid) url += '&service_id='+sid;
    window.location.href = url;
});
</script>
<?php endif; ?>

<?php if ($table=='contact_messages'): ?>
<div class="mb-3">
    <?php $currentFilter = $_GET['filter'] ?? 'unread'; ?>
    <a href="show.php?table=contact_messages" class="btn btn-outline-secondary btn-sm <?= $currentFilter==''?'active':'' ?>">All</a>
    <a href="show.php?table=contact_messages&filter=unread" class="btn btn-danger btn-sm <?= $currentFilter=='unread'?'active':'' ?>">Unread</a>
    <a href="show.php?table=contact_messages&filter=read" class="btn btn-success btn-sm <?= $currentFilter=='read'?'active':'' ?>">Read</a>
</div>
<?php endif; ?>

<!-- ===== SEARCH & ENTRIES SELECT ===== -->
<div class="table-top d-flex justify-content-between align-items-center mb-3">
  <div class="entries-select">
    <select id="entriesSelect" class="form-select-themed panel-small" onchange="changeEntries()">
      <?php foreach($perPageOptions as $opt): ?>
        <option value="<?= $opt ?>" <?= $perPage==$opt?'selected':'' ?>><?= $opt ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="table-search d-flex">
    <input type="text" id="tableSearch" placeholder="Search..." value="<?= htmlspecialchars($searchVal) ?>" class="panel-small me-2"/>
    <button type="button" id="searchBtn" class="btn btn-outline-secondary panel-small"><i class="bi bi-search"></i></button>
  </div>
</div>

<div class="table-responsive custom-table-responsive">
    <table class="custom-table w-100">
        <thead>
            <tr>
                <th>#</th>
                <?php foreach($fields as $field=>$type): ?>
                    <th><?= ucfirst(str_replace('_',' ',$field)) ?></th>
                <?php endforeach; ?>
                <th>Actions</th>
            </tr>
        </thead>
       <tbody>
<?php $i = $start + 1; while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $i ?></td>
        <?php foreach($fields as $field => $type): ?>
            <td>
                <?php
                $value = $row[$field] ?? '';

                // ===== FILE / IMAGE / VIDEO =====
                if (in_array($type, ['file','image']) || stripos($field,'image')!==false || stripos($field,'file')!==false) {
                    if (!empty($value)) {
                        $files = json_decode($value, true);
                        if (json_last_error() !== JSON_ERROR_NONE) $files = [$value];

                        foreach ($files as $f) {
                            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));

                            // Set correct upload folder
                            $uploadDir = 'uploads/';
                            if (strpos($field, 'service_image') !== false || $table == 'services') {
                                $uploadDir .= 'services/';
                            }

                            // Video
                            if (in_array($ext, ['mp4','webm','ogg'])) {
                                echo "<video src='{$uploadDir}{$f}' controls style='max-width:120px; max-height:80px; display:block; margin-bottom:5px;'></video>";
                            }
                            // Image
                            else {
                                echo "<img src='{$uploadDir}{$f}' class='table-thumb' style='margin-bottom:5px; display:block;'>";
                            }
                        }
                    }
                }
                // ===== TEXT / HTML =====
                elseif (stripos($field,'content')!==false || stripos($field,'description')!==false) {
                    echo "<div class='truncate-text'>".strip_tags($value)."</div>";
                }
                // ===== PHONE / CONTACT =====
                elseif (stripos($field,'phone')!==false || stripos($field,'contact')!==false || stripos($field,'number')!==false) {
                    $cleanNumber = preg_replace('/\D+/', '', $value);
                    echo "<div class='truncate-text'>".htmlspecialchars($value);
                    if ($cleanNumber) {
                        echo " <a href='https://wa.me/{$cleanNumber}' target='_blank' style='color:#25D366; margin-left:5px;'><i class='bi bi-whatsapp'></i></a>";
                    }
                    echo "</div>";
                }
                // ===== CONTACT MESSAGES STATUS =====
                elseif ($table == 'contact_messages' && $field == 'status') {
                    echo $value == 'unread' ? "<span class='badge bg-danger'>Unread</span>" : "<span class='badge bg-success'>Read</span>";
                }
                // ===== NORMAL TEXT =====
                else {
                    echo "<div class='truncate-text'>".htmlspecialchars($value)."</div>";
                }
                ?>
            </td>
        <?php endforeach; ?>
        <td class="table-actions">
            <?php if(!in_array($table,['admin','contact_messages'])): ?>
                <button onclick="window.location.href='edit.php?table=<?= $table ?>&id=<?= $row[$primaryKey] ?>'">
                    <i class="bi bi-pencil"></i> Edit
                </button>
            <?php endif; ?>
            <?php if($table=='contact_messages'): ?>
                <?php if($row['status']=='unread'): ?>
                    <button class="btn btn-sm btn-success" onclick="window.location.href='mark_status.php?id=<?= $row[$primaryKey] ?>&status=read&filter=unread'">
                        <i class="bi bi-envelope-open"></i> Mark Read
                    </button>
                <?php else: ?>
                    <button class="btn btn-sm btn-warning" onclick="window.location.href='mark_status.php?id=<?= $row[$primaryKey] ?>&status=unread&filter=read'">
                        <i class="bi bi-envelope"></i> Mark Unread
                    </button>
                <?php endif; ?>
            <?php endif; ?>
            <button class="btn btn-sm btn-danger" onclick="showDeleteModal('delete.php?table=<?= $table ?>&id=<?= $row[$primaryKey] ?>')">
                <i class="bi bi-trash"></i> Delete
            </button>
        </td>
    </tr>
<?php $i++; endwhile; ?>
</tbody>
    </table>
</div>

<!-- ===== PAGINATION ===== -->
<div class="pagination mt-3">
<?php if($page>1): ?>
  <a href="?table=<?= $table ?>&page=<?= $page-1 ?>&perPage=<?= $perPage ?>&search=<?= urlencode($searchVal) ?>" class="btn btn-outline-secondary">&laquo; Prev</a>
<?php endif; ?>
<?php for($p=1;$p<=$totalPages;$p++): ?>
  <a href="?table=<?= $table ?>&page=<?= $p ?>&perPage=<?= $perPage ?>&search=<?= urlencode($searchVal) ?>" class="btn <?= $p==$page?'btn-accent':'btn-outline-secondary' ?>"><?= $p ?></a>
<?php endfor; ?>
<?php if($page<$totalPages): ?>
  <a href="?table=<?= $table ?>&page=<?= $page+1 ?>&perPage=<?= $perPage ?>&search=<?= urlencode($searchVal) ?>" class="btn btn-outline-secondary">Next &raquo;</a>
<?php endif; ?>
</div>

<!-- ===== DELETE MODAL ===== -->
<div class="modal" id="deleteModal">
  <div class="modal-content">
    <h3>Delete Record</h3>
    <p>Are you sure you want to delete this record? This action cannot be undone.</p>
    <div class="modal-actions">
      <button class="btn btn-secondary" id="cancelDelete">Cancel</button>
      <button class="btn btn-danger" id="confirmDelete">Delete</button>
    </div>
  </div>
</div>

<?php include 'partials/js.php'; ?>
<script>
let deleteUrl = '';
const deleteModal = document.getElementById('deleteModal');
const confirmDeleteBtn = document.getElementById('confirmDelete');
const cancelDeleteBtn = document.getElementById('cancelDelete');
function showDeleteModal(url){ deleteUrl=url; deleteModal.classList.add('show'); }
confirmDeleteBtn.addEventListener('click',()=>window.location.href=deleteUrl);
cancelDeleteBtn.addEventListener('click',()=>deleteModal.classList.remove('show'));

// ENTRIES SELECT
function changeEntries(){
    const perPage=document.getElementById('entriesSelect').value;
    const search=document.getElementById('tableSearch').value;
    let url='?table=<?= $table ?>&perPage='+perPage+'&search='+encodeURIComponent(search);
    <?php if($isChildTable && $serviceId): ?>
    url += '&service_id=<?= $serviceId ?>';
    <?php endif; ?>
    window.location.href=url;
}

// SEARCH
document.getElementById('searchBtn').addEventListener('click',()=>{
    const search=document.getElementById('tableSearch').value;
    const perPage=document.getElementById('entriesSelect').value;
    let url='?table=<?= $table ?>&perPage='+perPage+'&search='+encodeURIComponent(search);
    <?php if($isChildTable && $serviceId): ?>
    url += '&service_id=<?= $serviceId ?>';
    <?php endif; ?>
    window.location.href=url;
});
document.getElementById('tableSearch').addEventListener('keyup',(e)=>{if(e.key==='Enter') document.getElementById('searchBtn').click();});
</script>
</body>
</html>