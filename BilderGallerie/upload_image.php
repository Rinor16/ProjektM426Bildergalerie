<?php
require 'functions.php';

if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageName = $_FILES['image']['name'];
    $tempFilePath = $_FILES['image']['tmp_name'];
    
    uploadImage($conn, $imageName, $tempFilePath);
}
?>
