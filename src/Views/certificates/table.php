<?php
require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";

table(
    'sertifikat',
    ['Nama Sertifikat'],
    $certificates,
    function ($certificate) {
        return
            actionButton('visibility', $certificate['certificate_link'], 'blue') .
            deleteButton('sertifikat', "/certificates/" . $certificate['participant_id']);
    },
    ['participant_id', 'certificate_link'],
);
