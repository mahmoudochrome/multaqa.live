<?php

//for production only
//if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
//    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: ' . $location);
//    exit;
//}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/init.php';

$app = new App;