
<?php
require __DIR__ . "/../components/table.php";
require __DIR__ . "/../components/deleteButton.php";
// require __DIR__ . "/../components/actionButton.php";

table('divisi', ['ID', 'Nama Divisi'], $divisions, function ($division) {
    return
        actionButton('edit', "/divisions/" . $division['id'] . "/edit", 'orange') .
        deleteButton('divisi', "/divisions/" . $division['id']);
});
?>




