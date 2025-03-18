<!-- Halaman tambah participant -->

<!-- 
 
ini buat testing aja 
sama aj kek form.php

-->
<?php use App\Config\Config; ?>

<div>
    <h2>Add New Participant</h2>
    <form action="<?= Config::BASE_URL ?>/participants" method="POST">

        <input type="hidden" name="user_role" value="<?= isset($_SESSION['admin']) ? 'admin' : 'public' ?>">

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Training Date:</label><br>
        <input type="date" name="training_date" required><br><br>

        <label>Name:</label><br>
        <input type="text" name="p_name" required><br><br>

        <label for="division">Division:</label><br>
        <select id="division" name="division_id" required>
            <?php foreach ($divisions as $division): ?>
                <option value="<?= $division['id'] ?>"><?= htmlspecialchars($division['name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="facility">Facility:</label><br>
        <select id="facility" name="facility_id" required>
            <?php foreach ($facilities as $facility): ?>
                <option value="<?= $facility['id'] ?>"><?= htmlspecialchars($facility['name']) ?></option>
            <?php endforeach; ?>
        </select><br><br>


        <label>Phone Number:</label><br>
        <input type="text" name="phone_number"><br><br>

        <button type="submit">Submit</button>
    </form>
</div>