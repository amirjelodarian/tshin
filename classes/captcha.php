<?php
    session_start();
    header('Content-type: image/jpeg');
    $captcha_num = rand(1000,9999);
    $_SESSION["random_captcha_code"] = $captcha_num;
    $font_size = 26;
    $img_width = 114;
    $img_height = 32;
    $image = imagecreate($img_width, $img_height); // create background image with dimensions
    imagecolorallocate($image, 8, 224, 123); // set background color
    $text_color = imagecolorallocate($image, 255, 255, 255); // set captcha text color
    imagettftext($image, $font_size, -5, 17, 24, $text_color, '../fonts/IRANSans-web.ttf', $captcha_num);
    imagepng($image);
?>