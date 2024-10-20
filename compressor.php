<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]["name"])) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(["error" => "File is not an image."]);
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 5000000) { // 5MB
        echo json_encode(["error" => "Sorry, your file is too large."]);
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo json_encode(["error" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(["error" => "Sorry, your file was not uploaded."]);
    // if everything is ok, try to compress and return response
    } else {
        // Compress the image
        $original_size = $_FILES["image"]["size"];
        $compressed_image = compressImage($_FILES["image"]["tmp_name"]);
        $compressed_size = strlen($compressed_image);

        // Return response
        echo json_encode([
            "originalSize" => formatSizeUnits($original_size),
            "compressedSize" => formatSizeUnits($compressed_size),
            "downloadLink" => 'data:image/jpeg;base64,' . base64_encode($compressed_image)
        ]);
    }
}

function compressImage($source_file) {
    $info = getimagesize($source_file);
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source_file);
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source_file);
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source_file);

    ob_start(); // Turn on output buffering
    imagejpeg($image, NULL, 75); // Output the image
    $compressed_image = ob_get_contents(); // Get the image data
    ob_end_clean(); // Turn off output buffering

    imagedestroy($image);

    return $compressed_image;
}

function formatSizeUnits($bytes) {
    if ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}

?>
