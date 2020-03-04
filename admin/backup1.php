<?php
    header("Content-type: application/zip");
    $archive_file_name = "idcard_project.zip";
    header("Content-Disposition: attachment; filename=$archive_file_name");
    header("Content-length: " . filesize($archive_file_name));
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile("$archive_file_name");
 ?>
