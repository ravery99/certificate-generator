<!-- formnya panggil file /Views/partials/ -->

<h2>Edit Nama Fasilitas</h2>

<?php 
    $action = "/facilities/$id";
    $type = "Fasilitas";
    $name = $facility_name;
    $button_text = "Edit";

    include __DIR__ . "../partials/dropdown_form.php";
?>