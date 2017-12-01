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
try {
    $ip = getIP();
    $ts3 = TeamSpeak3::factory("serverquery://" . $config["Username"] . ":" . $config["Password"] . "@" . $config["IP"] . ":" . $config["qPort"] . "/?server_port=" . $config["Port"] . "&nickname=" . $config["Nickname"] . "");
    $arr_ClientList = $ts3->clientList(array("connection_client_ip" => $ip, "client_type" => 0));
    $comboboxValues = '';
    foreach ($arr_ClientList as $client) {
        $comboboxValues = $comboboxValues . '<option value="' . $client['client_unique_identifier'] . '|||' . $client['client_nickname'] . '">' . $client['client_nickname'] . ' (' . $client['client_unique_identifier'] . ')</option>';
    }
    echo $comboboxValues;
} catch (TeamSpeak3_Exception $error) {
}