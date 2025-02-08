<?php

// namespace App\Helpers;
// use App\Utils\UnitConverter;

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


    function getTextHeight($font_size, $font_file, $text) {
        $bbox = imagettfbbox($font_size, 0, $font_file, $text);
        return abs($bbox[5] - $bbox[1]); // Hitung tinggi dari bbox
    }

    function getTextboxX($image_width, $textbox_width_cm, $dpi) {
        $dpi_to_px = $dpi / 2.54; // Konversi cm ke px
        $textbox_width_px = $textbox_width_cm * $dpi_to_px; // Ubah cm ke px
        
        // Posisi X agar textbox ada di tengah gambar
        return ($image_width - $textbox_width_px) / 2;
    }
    
    function getCenteredTextXInTextbox($textbox_x, $textbox_width_cm, $dpi, $font_size, $font_file, $text) {
        $dpi_to_px = $dpi / 2.54; // Konversi cm ke px
        $textbox_width_px = $textbox_width_cm * $dpi_to_px; // Ubah cm ke px
        
        // Hitung lebar teks dalam px
        $bbox = imagettfbbox($font_size, 0, $font_file, $text);
        $text_width_px = abs($bbox[2] - $bbox[0]);
    
        // Posisi X agar teks ada di tengah textbox
        return $textbox_x + ($textbox_width_px - $text_width_px) / 2;
    }
       
    $image_width = 2000;
    $dpi = 171;
    $dpi_to_cm = 171 / 2.54;
    $training_name = "Training Sistem Informasi Manajemen Rumah Sakit";

    $y_nama = (6.97 * $dpi_to_cm) + 134.645669291;
    // $y_nama = (6.97 * $dpi_to_cm) + getTextHeight(76, $font_amsterdam, $name);
    $y_divisi = (11.65 * $dpi_to_cm) + getTextHeight(36, $font_libre, "Divisi " . $division);
    $y_faskes = (13.9 * $dpi_to_cm) + getTextHeight(36, $font_libre, $facility);
    $y_training = (15.3 * $dpi_to_cm) + getTextHeight(30, $font_barlow, $training_name);
    $y_tgl = (16.1 * $dpi_to_cm) + getTextHeight(30, $font_barlow, $training_date);
    
    
    function getClippedText($textbox_width_cm, $dpi, $font_size, $font_file, $text) {
        $dpi_to_px = $dpi / 2.54; // Konversi cm ke px
        $textbox_width_px = $textbox_width_cm * $dpi_to_px; // Konversi cm ke px
        $text_clipped = $text;
        
        while (true) {
            // Hitung lebar teks saat ini dalam px
            $bbox = imagettfbbox($font_size, 0, $font_file, $text_clipped);
            $text_width_px = abs($bbox[2] - $bbox[0]);
    
            // Jika teks masih muat, keluar dari loop
            if ($text_width_px <= $textbox_width_px) {
                break;
            }
    
            // Jika teks kepanjangan, potong satu karakter dari belakang
            $text_clipped = mb_substr($text_clipped, 0, -1);
        }
    
        return mb_strlen($text_clipped);
    }

    function shortenName($name, $max_length) {
        // Jika nama masih dalam batas, langsung return
        if (mb_strlen($name) <= $max_length) {
            return $name;
        }
    
        // Pecah nama menjadi array berdasarkan spasi
        $words = explode(' ', $name);
        $shortened_name = $words[0]; // Ambil kata pertama
        
        // Loop dari kata kedua sampai terakhir
        for ($i = 1; $i < count($words); $i++) {
            $initial = mb_substr($words[$i], 0, 1) . '.'; // Ambil inisial + titik
            $temp_name = $shortened_name . ' ' . $initial; // Gabungkan
    
            // Cek apakah masih dalam batas karakter
            if (mb_strlen($temp_name) > $max_length) {
                break; // Jika melebihi batas, berhenti
            }
    
            $shortened_name = $temp_name; // Update hasil sementara
        }
    
        return $shortened_name;
    }
    
    
    // Fixed Width Textbox (cm)
    $textbox_width_nama = 18.91;

    // Dapatkan batas maksimal karakter yang bisa muat dalam textbox
    $max_chars_nama = getClippedText($textbox_width_nama, $dpi, 76, $font_amsterdam, $name);
    
    // Pangkas teks jika melebihi batas karakter
    $name_short = shortenName($name, $max_chars_nama);
    
    // Posisi textbox
    $textbox_x_nama = getTextboxX($image_width, 18.91, $dpi);
    $textbox_x_divisi = getTextboxX($image_width, 17.97, $dpi);
    $textbox_x_faskes = getTextboxX($image_width, 17.97, $dpi);
    $textbox_x_training = getTextboxX($image_width, 22.46, $dpi);
    $textbox_x_tgl = getTextboxX($image_width, 22.46, $dpi);

    // Posisi teks dalam textbox
    $x_nama = getCenteredTextXInTextbox($textbox_x_nama, 18.91, $dpi, 76, $font_amsterdam, $name_short);
    $x_divisi = getCenteredTextXInTextbox($textbox_x_divisi, 17.97, $dpi, 36, $font_libre, "Divisi " . $division);
    $x_faskes = getCenteredTextXInTextbox($textbox_x_faskes, 17.97, $dpi, 36, $font_libre, $facility);
    $x_training = getCenteredTextXInTextbox($textbox_x_training, 22.46, $dpi, 30, $font_barlow, 
            "Dalam partisipasinya mengikuti kegiatan " . $training_name);
    $x_tgl = getCenteredTextXInTextbox($textbox_x_tgl, 22.46, $dpi, 30, $font_barlow, 
            "yang dilaksanakan oleh TRUSTMEDIS secara daring pada tanggal " . $training_date);

    imagettftext($image, 82, 0, $x_nama, $y_nama, $navy, $font_amsterdam, $name_short); // Nama Peserta
    imagettftext($image, 36, 0, $x_divisi, $y_divisi, $green, $font_libre, "Divisi " . $division); // Divisi
    imagettftext($image, 36, 0, $x_faskes, $y_faskes, $green, $font_libre, $facility); // Faskes
    imagettftext($image, 30, 0, $x_training, $y_training, $navy, $font_barlow, 
        "Dalam partisipasinya mengikuti kegiatan " . $training_name);
    imagettftext($image, 30, 0, $x_tgl, $y_tgl, $navy, $font_barlow, 
        "yang dilaksanakan oleh TRUSTMEDIS secara daring pada tanggal " . $training_date);

    $filename = '../storage/certificates/' . str_replace(' ', '_', $name) . '.png';
    imagepng($image, $filename);
    imagedestroy($image);

    return $filename;
}
?>
