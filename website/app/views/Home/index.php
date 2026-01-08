<?php
$title = "Multaqa.live Home Page";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/head.php';
?>
</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/header.php'; ?>

    <div class="pagebody">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/general.aside.php'; ?>
        <article>
            <?php  if (!isset($_SESSION['user_id'])) {
                require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/landing.body.php';
            } else {
                echo 'spaces system is under construction!';
            }?>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templates/footer.php'; ?>

</div>
</body>
</html>