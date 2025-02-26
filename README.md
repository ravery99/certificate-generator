# certificate-generator

Certificate Generator adalah aplikasi untuk membuat sertifikat otomatis dari data hasil Google Forms. 

Peserta terlebih dahulu menginputkan datanya melalui Google Forms, lalu tidak lama kemudian akan mendapatkan email berisi tautan untuk melihat dan mengunduh sertifikat miliknya. Apabila sertifikat tersebut sudah terhapus, maka Peserta tidak bisa mengaksesnya lagi.

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

## Persyaratan 
- PHP 8.2 atau lebih tinggi
- Composer
- Server Web (seperti Apache)
- Ngrok (untuk testing)

## Persiapan 
### Template Sertifikat
1. Buat template gambar sertifikat di Canva.
2. Catat keterangan posisi setiap teks yang ingin ditampilkan. Contoh yang digunakan dalam aplikasi ini: tinggi, lebar, koordinat x, koordinat y, font size, font color, font family.
3. Semua posisi tersebut tertera dalam satuan CM. Namun, aplikasi ini sudah otomatis akan mengonversinya ke PX.

### Google Apps Scripts
1. Salin semua file yang ada di folder /src/Scripts ke Google Apps Script.
2. Beri trigger/pemicu pada tombol 'Kirim' dengan fungsi onFormSubmit.
3. Apabila belum memiliki domain publik, aktifkan ngrok. Salin domain pada bagian Forwarding.
4. Tempel domain tersebut pada Google Apps Script fungsi sendToWebhook.

### Install Packages & Libraries
1. Install Composer.
2. Install package Phroute.
Install

### Email Pengirim
1. Nyalakan verifikasi 2 langkah pada akun email pengirim. 
    1. Pergi ke https://myaccount.google.com/.
    2. Klik *Security*.
    3. Pada bagian *Signing in to Google*, klik *2-Step Verification*.
    4. Klik *GET STARTED*.
    5. Ketikkan kata sandi akun, lalu gunakan ponselmu untuk mengonfirmasi proses. Klik *CONTINUE*.
    6. Tambahkan opsi cadangan. Klik *NEXT*.
    7. Klik *TURN ON* untuk menyalakan verifikasi 2 langkah.
2. Buat kata sandi aplikasi (app password).
    1. Pergi ke https://myaccount.google.com/apppasswords.
    2. Konfirmasi kredensial. Ketikkan kata sandi akun.
    3. Ketikkan nama aplikasi, "Certificate Generator".
    6. Klik *Create*.
    7. Salin app password yang tampil dan tempelkan pada variabel $this->mail->Password di kelas EmailService.

### Koneksi Database
1. 

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
    - Peserta dapat melihat dan mengunduh sertifikat miliknya pada tautan tersebut, sampai dengan sertifikat itu dihapus dari aplikasi ini.

## Kekurangan
1. Aplikasi belum memiliki fitur penghapusan otomatis untuk sertifikat yang sudah melewati batas waktu tertentu. Akibatnya, data dapat menumpuk, sehingga perlu dilakukan penghapusan secara manual.
2. Apabila terdapat beberapa Peserta yang mengisi Google Form di waktu bersamaan, maka aplikasi hanya akan mencatat tautan ke Peserta terakhir di Google Sheets. Meskipun begitu, semua Peserta tetap akan menerima tautan sertifikat mereka melalui email dengan benar. Masalah ini hanya terjadi pada pencatatan di Google Sheets. 