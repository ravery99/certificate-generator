# certificate-generator

Certificate Generator adalah aplikasi untuk membuat sertifikat otomatis dari data hasil Google Forms. 

Peserta terlebih dahulu menginputkan datanya melalui Google Forms, lalu tidak lama kemudian akan mendapatkan email berisi tautan untuk melihat dan mengunduh sertifikat miliknya. Sertifikat pada tautan tersebut hanya bisa diakses selama satu bulan. Setelah itu, sudah tidak akan bisa diakses lagi.

Data yang diinputkan terdiri dari:
1. Email
2. Tanggal Training
3. Nama Peserta
4. Divisi
5. Fasilitas Kesehatan


## Teknologi Yang Digunakan
- Google Forms & Google Sheets
- Google Apps Script
- PHP

## Alat Desain
- Canva

## Persyaratan Sistem
- PHP 8.2 atau lebih tinggi
- Composer
- Server Web (seperti Apache)
- Ngrok (untuk testing)

## Persiapan Sistem
1. Buat template gambar sertifikat di Canva.
2. Catat keterangan posisi setiap teks yang ingin ditampilkan. Contoh yang digunakan dalam aplikasi ini: tinggi, lebar, koordinat x, koordinat y, font size, font color, font family.
3. Semua posisi tersebut tertera dalam satuan CM. Namun, aplikasi ini sudah otomatis akan mengonversinya ke PX.

## Alur Kerja Sistem
1. Pengumpulan Data
    - Peserta mengisi data dan mengklik 'Kirim' pada Google Form.
    - Data tersebut tersimpan otomatis ke dalam Google Sheets.
2. Pemrosesan Data
    - Aplikasi membaca data dari Google Forms setiap kali ada Peserta yang mengklik 'Kirim'.
    - Google Apps Script akan menangkap data tersebut dan mengirimkannya ke aplikasi.
3. Pembuatan Sertifikat
    - Aplikasi menggunakan template gambar sertifikat dalam format PNG yang sudah dibuat di Canva.
    - Data yang diinputkan akan masuk secara otomatis ke dalam sertifikat.
    - Setelah selesai, aplikasi akan mengirimkan tautan halaman sertifikat tersebut ke Google Apps Script.
4. Pengiriman Sertifikat
    - Setelah mengisi Google Forms, akan ada pesan email masuk ke alamat email Peserta.
    - Pesan tersebut berisi tautan yang mengarah ke halaman website yang menampilkan sertifikat hasil pembuatan aplikasi ini.
    - Peserta dapat melihat dan mengunduh sertifikat miliknya pada tautan tersebut, dengan batas waktu selama satu bulan.
    - Setelah lewat dari satu bulan, aplikasi akan otomatis menghapus gambar sertifikat tersebut dalam sistem.
