
<?php
require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";

table('fasilitas', ['ID', 'Nama Fasilitas'], $facilities, function ($facility) {
    return
        actionButton('edit', "/facilities/" . $facility['id'] . "/edit", 'orange') .
        deleteButton('fasilitas', "/facilities/" . $facility['id']);
});
?>