<?php
function srandom($Length) {
    $Chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($Chars), 0, $Length);
}

$config = array(); //Creates Config Array
$config["Username"] = "user"; //Query Login
$config["Password"] = "xxxx"; //Query Password
$config["IP"] = "1.1.1.1"; //Server IP/Domain
$config["Port"] = "9987"; //Server Port
$config["qPort"] = "10011"; // Query Port, Default 10011
$config["Nickname"] = rawurlencode("Bot" . srandom(5)); // Random name to prevent doublenicknames
$config["dbserver"] = "localhost";
$config["dbuser"] = "user";
$config["dbpassword"] = "xxxx";
$config["dbname"] = "coinhive_teamspeak";

$config["afterRegUrl"] = ""; //URL where users should go after registering. https://example.com/miner.html
$config["secretKey"] = ""; //Coinhive secretKey for site cT0QJghnNgdw0NMxV21xWz52rSfaWm8Go
$config["servergroupid"] = ""; //Server group id users get when mining enough
$config["hashes"] = 3000000; //Hashes needed to be mined until getting group


date_default_timezone_set('Europe/Berlin');
$current_date = date('Y-m-d H:i:s');


function getIP() {
    $ip = '';
    // Precedence: if set, HTTP_CF_CONNECTING_IP -> REMOTE_ADDR
    $headers = array('HTTP_CF_CONNECTING_IP', 'REMOTE_ADDR');
    foreach ($headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ip = $_SERVER[$header];
            break;
        }
    }
}