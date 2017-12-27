<?php
/*
 * Created by PhpStorm.
 * User: DatDraggy
 *
 * MIT License
 *
 * Copyright (c) 2017 DatDraggy
 */
require_once('./TeamSpeak3/TeamSpeak3.php');
require_once('./config.php');

$reg_names = explode('|||', $_POST['reg_names']);
$uid = $reg_names[0];
$client_name = htmlspecialchars($reg_names[1]);
if (empty($uid)) {
    die('Post-Only enabled webpage. Please use the form.');
}
$i = 0;
$visited = 0;
checkports($config["ports"]);
foreach ($config["ports"] as $port) {
    try {
        $ts3 = TeamSpeak3::factory("serverquery://" . $config["username"] . ":" . $config["password"] . "@" . $config["ip"] . ":" . $config["qPort"] . "/?server_port=" . $port . "&nickname=" . $config["nickname"] . "");
        $dbid = $ts3->clientFindDb($uid, true)[0];
        $visited += 1;
    } catch (TeamSpeak3_Exception $error) {
    }
    $i += 1;
}

if ($visited = 0) {
    die("Possible XSS. Could not find UID on teamspeak server. Please contact the administrator.");
}

try {
    $conn = new PDO('mysql:dbname=' . $config['dbname'] . ';host=' . $config['dbserver'] . ';charset=utf8', $config['dbuser'], $config['dbpassword']);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $txt = __FILE__ . ' Error: ' . $e->getMessage();
    file_put_contents("./log/reg_user.log", $txt . "\n", FILE_APPEND);
    // you have to create the log directory and allow the webserver user to write. Or make permissions 777
}
try {
    $sql = "INSERT INTO `ts_users`(`name`,`uid`,`mining`,`date`) VALUES (:client_name,:uid,'1',:current_date) ON DUPLICATE KEY UPDATE `id`=`id`";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->bindParam(':current_date', $current_date);
    $stmt->bindParam(':client_name', $client_name);
    $stmt->execute();
} catch (PDOException $e) {
    $txt = __FILE__ . ' Error: ' . $e;
    file_put_contents("./log/reg_user.log", $txt . "\n", FILE_APPEND);
    // you have to create the log directory and allow the webserver user to write. Or make permissions 777
}
header("Location: " . $config["afterRegUrl"]);