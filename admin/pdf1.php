<?php
    require('includes/init.php');

    if($session->is_signed_in()){
        $user = new User();
        $photo = new Photo();

        $user = $user->find_by_id($session->user_id);
        $properties = get_object_vars($user);//assoc_array
        $keys = array_keys($properties);
        $values = array_values($properties);

        $photo = $photo->find_by_username($user->username);
        $img_url = "images".DS.$photo->filename;
    }
 ?>
<?php

    require('fpdf181/fpdf.php');

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(140,20,'COENSOBEC ID CARD',1,1,'C');
    $pdf->Image('index.png',12.5,12.5,15,15);
    $pdf->Image($img_url,122.5,12.5,15,15);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(140,10,'Name : '. $user->username,1);
    $pdf->Ln(10);
    $pdf->Cell(140,20,'Address : '.$user->address,1);
    $pdf->Ln(20);
    $pdf->Cell(70,10,'Year Of Joining : '.$user->year,1);
    $pdf->Cell(70,10,'Programme : '.$user->program,1);

    $pdf->Output();
 ?>
