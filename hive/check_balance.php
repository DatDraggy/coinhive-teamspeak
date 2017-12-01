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
    $servergroupid = $config["servergroupid"];
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
        $number = number_format($hashesRemaining, 0, ',', '.');
        if ($hashes >= $hashesNeeded) {
            $ts3 = TeamSpeak3::factory("serverquery://" . $config["Username"] . ":" . $config["Password"] . "@" . $config["IP"] . ":" . $config["qPort"] . "/?server_port=" . $config["Port"] . "&nickname=" . $config["Nickname"] . "");
            $dbid = $ts3->clientFindDb($uid, true)[0];
            $groupIds = $ts3->clientGetByDbid($dbid)['client_servergroups'];
            if (strpos($groupIds, $servergroupid) === false) {
                $ts3->serverGroupClientAdd($servergroupid, $dbid);
            }
        }
        echo $number;
    }
}
