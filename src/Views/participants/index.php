<!-- Halaman tabel participant -->


<!-- 
    ini buat testing aja
-->

<?php use App\Config\Config; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Participants List</h2>

    <div class="mb-3">
        <a href="<?= Config::BASE_URL . '/participants/create' ?>" class="btn btn-primary">Tambah Peserta</a>
    </div>
   
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Training Date</th>
                <th>Name</th>
                <th>Division</th>
                <th>Facility</th>
                <th>Phone Number</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($participants)): ?>
                <tr>
                    <td colspan="8" class="text-center">No participants found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($participants as $participant): ?>
                    <tr>
                        <td><?= htmlspecialchars($participant['id']) ?></td>
                        <td><?= htmlspecialchars($participant['email']) ?></td>
                        <td><?= htmlspecialchars($participant['training_date']) ?></td>
                        <td><?= htmlspecialchars($participant['p_name']) ?></td>
                        <td><?= htmlspecialchars($participant['division_id']) ?></td>
                        <td><?= htmlspecialchars($participant['facility_id']) ?></td>
                        <td><?= htmlspecialchars($participant['phone_number'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($participant['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
