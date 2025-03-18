<?php

use App\Config\Config; ?>

<div>
    <h2>
        ini dashboard
    </h2>
    <div>
        <h3>Jumlah User</h3>
        <p> <?= $data["total_users"] ?> </p>
    </div>
    <div>
        <h3>Jumlah Partisipan</h3>
        <p> <?= $data["total_participants"] ?> </p>
    </div>
    <div>
        <h3>Jumlah Sertifikat</h3>
        <p> <?= $data["total_certificates"] ?> </p>
    </div>
    <div class="mb-3">
        <a href="<?= Config::BASE_URL . '/login' ?>" class="btn btn-danger">Log Out</a>
    </div>
</div>