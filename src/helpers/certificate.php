<?php
function generateCertificate($name, $date, $division, $facility) {
    $image = imagecreatefrompng('../src/template.png');
    $black = imagecolorallocate($image, 0, 0, 0);
    $font = '../src/helpers/arial.ttf'; // Pastikan file font ada
    
    imagettftext($image, 40, 0, 500, 350, $black, $font, $name);
    imagettftext($image, 25, 0, 500, 450, $black, $font, "Tanggal: " . $date);
    imagettftext($image, 25, 0, 500, 500, $black, $font, "Divisi: " . $division);
    imagettftext($image, 25, 0, 500, 550, $black, $font, "Fasilitas: " . $facility);
    
    $filename = '../storage/certificates/' . str_replace(' ', '_', $name) . '.png';
    imagepng($image, $filename);
    imagedestroy($image);

    return $filename;
}
?>
