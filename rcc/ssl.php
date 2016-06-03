<?php
// Marcel Kapfer (mmk2410) / Wilson O'Sullivan
// License: MIT License
// SSL Verification

if (isset($settings["rcc"]["debug"]) && $settings["rcc"]["debug"] != "on") {
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
        header('HTTP/1.1 400 Bad Request');
        exit();
    }
}
