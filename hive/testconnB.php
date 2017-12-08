<?php
require_once('./TeamSpeak3/TeamSpeak3.php');
require_once('./config.php');
if($_POST['password'] == ''){
    die("Wrong Pass");
}
if($_POST['password'] == $config['debugPass'] && $_POST['user'] != ''){
    try {
        $reg_names = explode('|||', $_POST['user']);
        $uid = $reg_names[0];
        $client_name = $reg_names[1];
        $i = 0;
        foreach ($config["ports"] as $port) {
            $ts3 = TeamSpeak3::factory("serverquery://" . $config["username"] . ":" . $config["password"] . "@" . $config["ip"] . ":" . $config["qPort"] . "/?server_port=" . $port . "&nickname=" . $config["nickname"] . "");
            $dbid = $ts3->clientFindDb($uid, true)[0];
            $groupIds = $ts3->clientGetByDbid($dbid)['client_servergroups'];
            if (strpos($groupIds, $config["servergroupid"][$i]) === false) {
                $ts3->serverGroupClientAdd($config["servergroupid"][$i], $dbid);

            }
            $i = $i + 1;
        }
        echo "Successfully added to client " . $client_name;
    } catch (TeamSpeak3_Exception $error) {
        echo "Error " . $error->getCode() . ": " . $error->getMessage() . "<br><br>" . $error . "<br><br>";
    }
}
else{
    echo "Wrong Pass";
}