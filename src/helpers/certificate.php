<?php
function generateCertificate($name, $date, $division, $facility) {
    $dateObject = new DateTime($date);

    // Formatter untuk tanggal dalam bahasa Indonesia
    $formatter = new IntlDateFormatter(
        'id_ID', 
        IntlDateFormatter::FULL, 
        IntlDateFormatter::NONE, 
        'Asia/Jakarta', 
        IntlDateFormatter::GREGORIAN,
        'd MMMM yyyy'
    );

    $training_date = $formatter->format($dateObject);


    $image = imagecreatefrompng('../src/template.png');
    $navy = imagecolorallocate($image, 3, 60, 84);
    $green = imagecolorallocate($image, 0, 191, 99);
    $font_amsterdam = '../src/helpers/AmsterdamFour.ttf';
    $font_libre = '../src/helpers/LibreBaskerville-Bold.ttf';
    $font_barlow = '../src/helpers/Barlow-Light.ttf';

    $dpi_to_cm = 171 / 2.54;
    
    imagettftext($image, 76, 0, (5.4 * $dpi_to_cm), (7.45 * $dpi_to_cm), $navy, $font_amsterdam, $name); // Nama Peserta
    imagettftext($image, 36, 0, (5.55 * $dpi_to_cm), (11.7 * $dpi_to_cm), $green, $font_libre, "Divisi " . $division); // Divisi
    imagettftext($image, 36, 0, (5.65 * $dpi_to_cm), (13.85 * $dpi_to_cm), $green, $font_libre, $facility); // Faskes
    imagettftext($image, 30, 0, (3.25 * $dpi_to_cm), (15 * $dpi_to_cm), $navy, $font_barlow, 
        "Dalam partisipasinya mengikuti kegiatan “Training Sistem Informasi Manajemen Rumah Sakit” 
        yang dilaksanakan oleh TRUSTMEDIS secara daring pada tanggal " . $training_date);

    $filename = '../storage/certificates/' . str_replace(' ', '_', $name) . '.png';
    imagepng($image, $filename);
    imagedestroy($image);

    return $filename;
}
?>
