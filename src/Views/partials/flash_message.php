<!-- flash message atur disini -->
<!-- edit div yg setelah isset dan sblm unset, itu tampilan flash msg nya -->

<?php if (isset($_SESSION['flash_message'])): ?>

    <div class="alert <?= $_SESSION['flash_message']['type'] ?>">
        <?= $_SESSION['flash_message']['message'] ?>
    </div>
    
    <?php unset($_SESSION['flash_message']); ?>

<?php endif; ?>
