<?php
// Create image instances
$src = imagecreatefromgif('php.gif');
$dest = imagecreatetruecolor(80, 40);

// Copy
imagecopy($dest, $src, 0, 0, 20, 13, 80, 40);

// Output and free from memory
header('Content-Type: image/gif');
imagegif($dest);

imagedestroy($dest);
imagedestroy($src);
?>
