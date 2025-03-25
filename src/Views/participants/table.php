
<?php
require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/deleteButton.php";

table(
    'peserta',
    [
        'ID',
        'Email',
        'Tanggal Pelatihan',
        'Nama Peserta',
        'Nomor HP',
        'Divisi',
        'Fasilitas',
    ],
    $participants,
    function ($participant) {
        return
            deleteButton('peserta', "/participants/" . $participant['id']);
    },
    ['facility_id', 'division_id']
);
?>