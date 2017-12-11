<?php
/*
 * Created by PhpStorm.
 * User: DatDraggy
 *
 * MIT License
 *
 * Copyright (c) 2017 DatDraggy
 */
function srandom($Length) {
    $Chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($Chars), 0, $Length);
}

$config = array();
$config["username"] = "user"; //Query Username
$config["password"] = "xxxx"; //Query Password
$config["ip"] = "1.1.1.1"; //TS Server IP/Domain
$config["ports"] = array("9987", "9988", "9989"); //TS Server Port
$config["qPort"] = "10011"; // TS Query Port, Default 10011
$config["nickname"] = rawurlencode("Bot_" . srandom(5)); // Random name to prevent double nickname error
$config["debugPass"] = ""; //Passwort for debug. Leave empty for security if not needed

$config["dbserver"] = "localhost"; //MySQL Server
$config["dbuser"] = "user"; //MySQL User
$config["dbpassword"] = "xxxx"; //MySQL Password
$config["dbname"] = "coinhive_teamspeak"; //MySQL Database

$config["afterRegUrl"] = ""; //URL where users should go after registering. https://example.com/miner.html
$config["secretKey"] = ""; //Coinhive secretKey for site cT0QJghnNgdw0NMxV21xWz52rSfaWm8Go
$config["servergroupid"] = array("21", "50", "89"); //Server group id users get when mining enough. First ID = First $config["ports"], second ID = second $config["ports"], and so on.
$config["hashes"] = 3000000; //Hashes needed to be mined until getting group

date_default_timezone_set('Europe/Berlin'); //Set this to your desired timezone. https://secure.php.net/manual/en/timezones.php


$current_date = date('Y-m-d H:i:s');

function getIP() {
    $ip = '';
    // Precedence: if set, HTTP_CF_CONNECTING_IP -> REMOTE_ADDR
    $headers = array('HTTP_CF_CONNECTING_IP', 'REMOTE_ADDR');
    foreach ($headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ip = $_SERVER[$header];
            return $ip;
            break;
        }
    }
}
function checkports() {
    if (is_array($config["ports"])) {
        die('Check ports in config.php. Has to look like $config["ports"] = array("9987")');
    } //Echo error if config is not updated. Happened in the past.
}