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

$comboboxValues = '<option value="">Select your name or register</option>';
try {
    $conn = new PDO('mysql:dbname=' . $config['dbname'] . ';host=' . $config['dbserver'] . ';charset=utf8', $config['dbuser'], $config['dbpassword']);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $txt = __FILE__ . ' Error: ' . $e->getMessage();
    file_put_contents("./log/get_names.log", $txt . "\n", FILE_APPEND);
}
$stmt = $conn->query("SELECT `name`,`uid` FROM `ts_users` WHERE `mining`=1");
foreach ($stmt as $row) {
    $comboboxValues = $comboboxValues . '<option value="' . $row['uid'] . '">' . $row['name'] . ' (' . $row['uid'] . ')</option>';
}
$stmt->execute();

echo $comboboxValues;