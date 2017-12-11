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

if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $secretKey = $config["secretKey"];
    $hashesNeeded = $config["hashes"];
    if (!empty($uid)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.coinhive.com/user/balance?name={$uid}&secret={$secretKey}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($json, true);
        $hashes = $data['total'];
        $hashesRemaining = $hashesNeeded - $hashes;

        //Change number format here
        $number = number_format($hashesRemaining, 0, '.', ',');

        if ($hashes >= $hashesNeeded) {
            try {
                $i = 0;
                checkports();
                foreach ($config["ports"] as $port) {
                    $ts3 = TeamSpeak3::factory("serverquery://" . $config["username"] . ":" . $config["password"] . "@" . $config["ip"] . ":" . $config["qPort"] . "/?server_port=" . $port . "&nickname=" . $config["nickname"] . "");
                    $dbid = $ts3->clientFindDb($uid, true)[0];
                    $groupIds = $ts3->clientGetByDbid($dbid)['client_servergroups'];
                    if (strpos($groupIds, $config["servergroupid"][$i]) === false) {
                        $ts3->serverGroupClientAdd($config["servergroupid"][$i], $dbid);
                    }
                    $i = $i + 1;
                }
                //empty catch because would throw an error if client has never visted one of the servers
            } catch (TeamSpeak3_Exception $error) {
            }
        }
        echo $number;
    }
}