<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="bi-check-circle-fill"></i>
        <strong>
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </strong>
    </div>
<?php endif ?>