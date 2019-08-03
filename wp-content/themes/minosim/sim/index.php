<?php
    $number = $_GET['sim'];
    $site = 'Website: mino.vn';
    $network = $_GET['network'];
    $type = 'Thiết kế web sim';
    //Set the Content Type
    header('Content-type: image/jpeg');
    
    // Create Image From Existing File
    $jpg_image = imagecreatefromjpeg('images/' . $network . '.jpg');
    
    // Allocate A Color For The Text
    $white = imagecolorallocate($jpg_image, 0, 0, 0);
    
    // Set Path to Font File
    $font_path = 'fonts/font.ttf';
    
    // Print Text On Image
    imagettftext($jpg_image, 25, 0, 220, 140, $white, $font_path, $number);
    imagettftext($jpg_image, 18, 0, 220, 180, $white, $font_path, $type);
    imagettftext($jpg_image, 18, 0, 220, 220, $white, $font_path, $site);
    
    $logo = imagecreatefrompng('images/logo.png');
    
    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = 78;
    $marge_bottom = 78;
    $sx = imagesx($logo);
    $sy = imagesy($logo);
    
    // Copy the stamp image onto our photo using the margin offsets and the photo 
    // width to calculate positioning of the stamp. 
    imagecopy($jpg_image, $logo, imagesx($jpg_image) - $sx - $marge_right, imagesy($jpg_image) - $sy - $marge_bottom, 0, 0, imagesx($logo), imagesy($logo));
    
    // Send Image to Browser
    imagejpeg($jpg_image);
    
    // Clear Memory
    imagedestroy($jpg_image);
?>