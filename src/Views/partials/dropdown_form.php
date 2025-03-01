<!-- ini form create/edit untuk divisi & fasilitas -->
<!-- file ini dipanggil di create.php & edit.php pada folder /Views/divisions dan /Views/facilities -->
<!-- jadi nanti di kedua file itu, tinggal kirim variabel2 yg dibutuhin -->

<form action="<?= $action ?>" method="POST">
    <label for="name">Nama <?= $type ?> </label>
    <input type="text" name="name" value="<?= $name ?>">
    <button type="submit"><?= $button_text ?></button>
</form>