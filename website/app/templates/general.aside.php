<aside>
    <?php
    if (!isset($_SESSION['user_id']))
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/login.box.php';
    else require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/pfp.box.php';
    ?>
</aside>