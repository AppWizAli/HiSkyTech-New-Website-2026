<?php
if (isset($_FILES['upload'])) {
    $file = $_FILES['upload'];
    $fileName = basename($file['name']);
    $fileTmp = $file['tmp_name'];
    $fileError = $file['error'];

    // Set the upload directory
    $uploadDir = 'uploads/';

    // Create the upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Check for upload errors
    if ($fileError === UPLOAD_ERR_OK) {
        $targetFile = $uploadDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmp, $targetFile)) {
            $funcNum = $_GET['CKEditorFuncNum'];
            $url = $targetFile; // URL of the uploaded image
            $message = ''; // Success message

            // Return the URL to CKEditor
            echo "<script>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        echo "File upload error.";
    }
}
