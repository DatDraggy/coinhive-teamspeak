<?php
/*
 * Created by PhpStorm.
 * User: DatDraggy
 *
 * MIT License
 *
 * Copyright (c) 2017 DatDraggy
 */
require_once('./config.php');

$reg_names = explode('|||', $_POST['reg_names']);
$uid = $reg_names[0];
$client_name = $reg_names[1];
if (empty($uid)) {
    die('Post-Only enabled webpage. Please use the form.');
}
try {
    $conn = new PDO('mysql:dbname=' . $config['dbname'] . ';host=' . $config['dbserver'] . ';charset=utf8', $config['dbuser'], $config['dbpassword']);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $txt = __FILE__ . ' Error: ' . $e->getMessage();
    file_put_contents("./log/reg_user.log", $txt . "\n", FILE_APPEND);
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
}
header("Location: " . $config["afterRegUrl"]);