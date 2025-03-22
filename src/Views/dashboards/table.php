
<?php
require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";

table(
    'peserta',
    [
        'Email',
        'Tanggal Pelatihan',
        'Nama Peserta',
    ],
    $participants,
    function ($participant) {
        return
            actionButton('visibility', $participant['certificate_link'] ?? "/certificates/show", 'blue') .
            deleteButton('peserta', "/participants/" . $participant['id']);
    },
    [
        'id',
        'facility_id',
        'division_id',
        'facility_name',
        'division_name',
        'phone_number',
        'participant_id',
        'certificate_filename',
        'certificate_link'
    ]
);
?>