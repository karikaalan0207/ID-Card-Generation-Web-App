<?php
    require('includes/init.php');

    if($session->is_signed_in()){
        $user = new User();
        $user = $user->find_by_id($session->user_id);
    }
 ?>

<?php
    $society = "COMPUTER ENGINEERS'S SOCIETY OF BE COLLEGE";
    $place = "HOWRAH-711103, WEST BENGAL, INDIA";
    $name = strtoupper("NAME     :  " . $user->username);
    $course = strtoupper("COURSE    :  " . $user->program);
    $id_number = "ID NUMBER :  " . (510517000 + $user->id);
    $year = "YEAR      :  " . $user->year;
    $address = "Address :  " . $user->address . ", " . "district - " . $user->district . " , " . " state - " . $user->state . ", ". " india";
    $address = strtoupper($address);
    $pdf_store_location = "pdfs/" . $user->username . ".pdf";
    $logo = "images/index.png";
    $profile_pic_loc = "images/" . $user->username . ".jpg";
    $width = 200;
    $height = 200;
 ?>

<?php
    require('fpdf181/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',20);
    $pdf->Write(10, $society);
    $pdf->Ln();
    $pdf->setLeftMargin(45);
    $pdf->SetFont('Arial','B',17);
    $pdf->Write(10, $place);
    $pdf->setLeftMargin(15);
    $pdf->Ln(30);
    $pdf->SetFont('Arial','B',11);
    $pdf->Write(10, $name);
    $pdf->Ln();
    $pdf->Write(10, $course);
    $pdf->Ln();
    $pdf->Write(10, $id_number);
    $pdf->Ln();
    $pdf->Write(10, $year);
    $pdf->Ln();
    $pdf->Write(10, $address);
    $pdf->Image($logo, 15, 21);

    //image resizing
    $profile_pic = imagecreatefromjpeg($profile_pic_loc);
    $profile_resized = imagescale($profile_pic,$width, $height, IMG_BILINEAR_FIXED);
    imagejpeg($profile_resized, $profile_pic_loc, 99);
    imagedestroy($profile_pic);
    imagedestroy($profile_resized);

    //profile pic insertion after resizing
    $pdf->Image($profile_pic_loc, 150, 35, 50, 50);


    $pdf->Output();
    $pdf->Output('F', $pdf_store_location);//saving to some location

?>
