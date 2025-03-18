<?php
use App\Config\Config;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <?php
    $formTitle = "Form Pendaftaran Admin";
    $formAction = Config::BASE_URL . "/users";
    $username = " ";
    $buttonText = "Daftar";

    include(__DIR__ . '/../partials/user_form.php');
    ?>
</body>

</html>