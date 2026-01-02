<?php
$title = "Multaqa.live Home Page";
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/head.php';
?>
</head>
<body>
<div class="container">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/header.php'; ?>

    <div class="pagebody">
        <aside>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/login.box.php'; ?>
        </aside>
        <article>
            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/landing.body.php'; ?>
        </article>
    </div>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/app/templets/footer.php'; ?>

</div>
</body>
</html>