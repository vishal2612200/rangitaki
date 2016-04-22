<?php
// Marcel Kapfer (mmk2410)
// License: MIT License
// api digest auth

require 'DigestAuth.php';

require '../../password.php';

use \mmk2410\rbe\digestAuth\DigestAuth as DigestAuth;

$realm = 'Restricted area';

$users = array($username => $password);

if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="'.$realm.
           '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

    die('Access to RCC API not granted');
}


// analyze the PHP_AUTH_DIGEST variable
if (!($data = DigestAuth::httpDigestParse($_SERVER['PHP_AUTH_DIGEST'])) ||
    !isset($users[$data['username']])) {
    var_dump($_SERVER["PHP_AUTH_DIGEST"]);
    die('Wrong Credentials!');
}


// generate the valid response
$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] != $valid_response) {
    var_dump($_SERVER["PHP_AUTH_PW"]);
    die('Wrong Credentials!');
}
