<?php if (isset($_SESSION['errors'])) {?>
    <div class="errors">
        <h3>Error!</h3>
        <?php
        foreach ($_SESSION['errors'] as $error) echo "<p id='". $error  ."'></p><hr>";
        unset($_SESSION['errors']);
        ?>
    </div>
<?php } ?>