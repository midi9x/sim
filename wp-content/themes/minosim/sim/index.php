<?php
    include '../config.php';
    $number = $_GET['sim'];
    $gia = $_GET['gia'];
    $loai = 'Loại sim: ' . getLoaiSim($number);
    $site = 'Website: mino.vn';
    $network = $_GET['network'];
    $type = 'Giá: ' . number_format($gia) . ' đ';
    //Set the Content Type
    header('Content-type: image/jpeg');

    // Create Image From Existing File
    $jpg_image = imagecreatefromjpeg('images/' . $network . '.jpg');

    // Allocate A Color For The Text
    $white = imagecolorallocate($jpg_image, 0, 0, 0);

    // Set Path to Font File
    $font_path = 'fonts/font.ttf';


    $logo = imagecreatefrompng('images/logo.png');

    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = 78;
    $marge_bottom = 78;
    $sx = imagesx($logo);
    $sy = imagesy($logo);

    // Copy the stamp image onto our photo using the margin offsets and the photo
    // width to calculate positioning of the stamp.
    imagecopy($jpg_image, $logo, imagesx($jpg_image) - $sx - $marge_right, imagesy($jpg_image) - $sy - $marge_bottom, 0, 0, imagesx($logo), imagesy($logo));

    // Print Text On Image
    imagettftext($jpg_image, 20, 0, 220, 135, $white, $font_path, $number);
    imagettftext($jpg_image, 16, 0, 220, 165, $white, $font_path, $type);
    imagettftext($jpg_image, 16, 0, 220, 195, $white, $font_path, $loai);
    imagettftext($jpg_image, 16, 0, 220, 225, $white, $font_path, $site);

    // Send Image to Browser
    imagejpeg($jpg_image);

    // Clear Memory
    imagedestroy($jpg_image);
?>