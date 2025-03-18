<!-- Halaman login admin -->

<?php use App\Config\Config; ?>

<h2>Login</h2>

<form action="<?= Config::BASE_URL ?>/login" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="<?= Config::BASE_URL ?>/register">Daftar</a></p>