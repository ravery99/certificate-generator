<!-- 
 
ini buat testing aja 

-->
<?php use App\Config\Config; ?>

<div>
    <h2>Add New Participant</h2>
    <form action="<?= Config::BASE_URL ?>/participants" method="POST">
        <input type="hidden" name="role" value="<?= isset($_SESSION['admin']) ? 'admin' : 'public' ?>">

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Training Date:</label><br>
        <input type="date" name="training_date" required><br><br>
        
        <label>Name:</label><br>
        <input type="text" name="p_name" required><br><br>
        
        <label>Division:</label><br>
        <input type="text" name="division" required><br><br>
        
        <label>Facility:</label><br>
        <input type="text" name="facility" required><br><br>
        
        <label>Phone Number:</label><br>
        <input type="text" name="phone_number" required><br><br>
        
        <button type="submit">Submit</button>
    </form>
</div>