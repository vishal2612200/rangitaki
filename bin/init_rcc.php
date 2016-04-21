<?php
// Marcel Kapfer (mmk2410)
// PHP script for initializing the RCC
// License: MIT

require 'res/php/Config.php';

use mmk2410\rbe\config\Config as Config;

echo 'RCC Initializion Script' . "\n";
$username = readline("Username: ");

if ($username == "") {
    echo "No username given. Aborting...\n";
    exit();
}

echo 'Password: ';
$password = exec('read -s PW; echo $PW');

if ($password == "") {
    echo "No password given. Aborting...\n";
    exit();
}

$hash = password_hash($password, PASSWORD_BCRYPT);

$username = '$username = "' . $username . '";';
$hash = '$hash = "' . $hash . '";';

$file = '<?php' . "\n" . $username . "\n" . $hash . "\n";

if (file_put_contents('./rcc/password.php', $file)) {
    echo "\nPassword hash successfully saved.\n";
}

$config = new Config('config.yaml', 'vendor/autoload.php');

$yaml = $config->getConfig();

$rccOn = "";

while (!(in_array($rccOn, array("y", "Y", "n", "N")))) {
    $rccOn = readline("Enable RCC: (y/n) ");
}

if (in_array($rccOn, array("y", "Y"))) {
    $yaml["rcc"]["rcc"] = "on";
} else {
    $yaml["rcc"]["rcc"] = "off";
}

$apiOn = "";

while (!(in_array($apiOn, array("Y", "y", "n", "N")))) {
    $apiOn = readline("Enable RCC API: (y/n) ");
}

if (in_array($apiOn, array("y", "Y"))) {
    $yaml["rcc"]["api"] = "on";
} else {
    $yaml["rcc"]["api"] = "off";
}

$config = new Config('config.yaml', 'vendor/autoload.php');

if ($config->writeConfig($yaml)) {
    echo "Changes saved.\n";
} else {
    echo "Failed to save changes.\n";
}
