<?php
    header("Content-Type: image/jpeg");
    require('includes/init.php');
    if($session->is_signed_in()){
        $user = new User();
        $user = $user->find_by_id($session->user_id);

    }


    $society = "COMPUTER ENGINEERS'S SOCIETY OF BE COLLEGE";
    $place = "HOWRAH-711103, WEST BENGAL, INDIA";
    $name = strtoupper("NAME     :  " . $user->username);
    $course = strtoupper("COURSE    :  " . $user->program);
    $id_number = "ID NUMBER :  " . (510517000 + $user->id);
    $year = "YEAR      :  " . $user->year;
    $address = "Address :  " . $user->address . ", " . "district - " . $user->district . " , " . " state - " . $user->state . ", ". " india";
    $address = strtoupper($address);
    $image_store_location = "images/" . $user->username . ".jpeg";
    $fonts = "fonts/TCCEB.TTF";
    $logo = "images/index.png";
    $profile_pic = "images/" . $user->username . ".jpg";
    $width = 200;
    $height = 200;

    $white_bg_img = imagecreate(1080,450);//creates image
    imagecolorallocate($white_bg_img,255,255,255);//sets the color to white

    $heading_color = imagecolorallocate($white_bg_img,233,128,19);
    $black = imagecolorallocate($white_bg_img,0,0,0);//color of the image that can be used later

    $co_ordinates = imagettftext($white_bg_img, 40, 0, 50, 50, $heading_color, $fonts, $society);
    $co_ordinates = imagettftext($white_bg_img, 30, 0, 200, 100, $heading_color, $fonts, $place);
    $co_ordinates = imagettftext($white_bg_img, 20, 0, 50, 250, $black, $fonts, $name);
    $co_ordinates = imagettftext($white_bg_img, 20, 0, 50, 290, $black, $fonts, $course);
    $co_ordinates = imagettftext($white_bg_img, 20, 0, 50, 330, $black, $fonts, $year);
    $co_ordinates = imagettftext($white_bg_img, 20, 0, 50, 370, $black, $fonts, $id_number);

    // imageline($white_bg_img, 50, 340, 1035, 340, $heading_color );

    $co_ordinates = imagettftext($white_bg_img, 20, 0, 50, 410, $black, $fonts, $address);

    $logo = imagecreatefrompng($logo);

    $profile_pic = imagecreatefromjpeg($profile_pic);
    $profile_resized = imagescale($profile_pic,$width, $height, IMG_BILINEAR_FIXED);
    $result = imagecopy($white_bg_img, $logo, 50, 70, 0, 0, 92, 111);
    $result = imagecopy($white_bg_img, $profile_resized, 850, 150, 0, 0, $width, $height);
    imagejpeg($white_bg_img,$image_store_location, 99);
    imagejpeg($white_bg_img);
    imagedestroy($white_bg_img);
    imagedestroy($logo);
    imagedestroy($profile_pic);
    imagedestroy($profile_resized);
 ?>
