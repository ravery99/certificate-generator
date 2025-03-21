<!-- isinya sama kek users/create -->
 <!-- 
    tinggal panggil itu aja nanti,
    atau sebaliknya. ini yg dipanggil disitu. bebas.
 -->

 <?php use App\Config\Config; ?>

    <h2>Registrasi</h2>

    <form action="<?= Config::BASE_URL ?>/register" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="<?= Config::BASE_URL ?>/login">Login</a></p>

