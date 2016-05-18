<?php
// Marcel Kapfer (mmk2410)
// License: MIT License
// HTTP Basic Auth for the API

$basedir = "../../../";

require '../../ssl.php';

require '../../password.php';

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="RCC API"');
    header('HTTP/1.1 401 Unauthorized');
    echo "Access denied to the RCC API!";
    exit;
} elseif ($_SERVER['PHP_AUTH_USER'] != $username ||
    !password_verify($_SERVER['PHP_AUTH_PW'], $password)) {
        header('HTTP/1.1 401 Unauthorized');
    echo "Wrong credentials: Access denied!";
    exit;
}
