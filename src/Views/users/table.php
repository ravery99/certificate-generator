
<?php
require_once __DIR__ . "/../components/table.php";
require_once __DIR__ . "/../components/deleteButton.php";
require_once __DIR__ . "/../components/actionButton.php";

// var_dump($users);
table('admin', ['ID', 'Nama Pengguna'], $results ?? $users, function ($user) {
    return
        actionButton('edit', "/users/" . $user['id'] . "/edit", 'orange') .
        deleteButton('admin', "/users/" . $user['id']);
}, ['password']);
?>