<?php
include "config/db.php";

$table = $_GET['table'] ?? die("Table not specified");
$id    = (int)($_GET['id'] ?? 0);

/* ===============================
   ALLOWED TABLES (WHITELIST)
================================ */
$allowedTables = [
    'trusted_brand',
    'industries_serve',
    'hero_section',
    'mobile_develop',
    'app_experties',
    'our_feature',
    'our_stack',
    'admin',
    'contact_messages',
    'blogs_content',
    'case_studies',
    'services',
    'teams',
    'portfolio'
];

if (!in_array($table, $allowedTables)) {
    die("Invalid table");
}

$pk = 'id';

/* ===============================
   FETCH RECORD
================================ */
$res = mysqli_query($conn, "SELECT * FROM `$table` WHERE `$pk` = $id LIMIT 1");

if (!$res || mysqli_num_rows($res) === 0) {
    header("Location: show.php?table=$table&error=Record+not+found");
    exit;
}

$record = mysqli_fetch_assoc($res);

/* ===============================
   HELPER: DELETE FILES/IMAGES/VIDEOS
================================ */
function deleteFilesFromRecord($record) {
    foreach ($record as $field => $value) {
        if (!empty($value)) {
            // Only delete fields that are file/image/video
            if (strpos($field,'image')!==false || strpos($field,'file')!==false || strpos($field,'video')!==false) {
                $files = json_decode($value,true);
                if(json_last_error()===JSON_ERROR_NONE && is_array($files)){
                    foreach($files as $f){
                        $path = __DIR__.'/uploads/'.$f;
                        if(file_exists($path)) unlink($path);
                    }
                } else {
                    $path = __DIR__.'/uploads/'.$value;
                    if(file_exists($path)) unlink($path);
                }
            }

            // Delete images inside HTML content (blogs_content)
            if($field==='blogs_content'){
                preg_match_all('/<img[^>]+src=["\']uploads\/([^"\']+)["\']/i',$value,$matches);
                if(!empty($matches[1])){
                    foreach($matches[1] as $img){
                        $imgPath = __DIR__.'/uploads/'.$img;
                        if(file_exists($imgPath)) unlink($imgPath);
                    }
                }
            }
        }
    }
}

/* ===============================
   DELETE CHILD RECORDS IF SERVICE
================================ */
if($table==='services'){
    $childTables = ['mobile_develop','app_experties','our_feature','our_stack'];
    foreach($childTables as $child){
        $childRes = mysqli_query($conn, "SELECT * FROM `$child` WHERE service_id=$id");
        while($childRow = mysqli_fetch_assoc($childRes)){
            deleteFilesFromRecord($childRow); // delete child files
            mysqli_query($conn,"DELETE FROM `$child` WHERE id=".$childRow['id']);
        }
    }
}

/* ===============================
   DELETE FILES OF THIS RECORD
================================ */
if($table!=='contact_messages'){
    deleteFilesFromRecord($record);
}

/* ===============================
   DELETE DATABASE RECORD
================================ */
mysqli_query($conn, "DELETE FROM `$table` WHERE `$pk`=$id");

/* ===============================
   REDIRECT
================================ */
header("Location: show.php?table=$table&success=Record+deleted");
exit;
?>