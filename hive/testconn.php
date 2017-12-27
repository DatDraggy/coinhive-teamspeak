<?php
require_once('./TeamSpeak3/TeamSpeak3.php');
require_once('./config.php');
echo '<!DOCTYPE html><html><head><script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script><meta charset="utf-8"></head><body>';
try {
    $comboboxValues = '<option value="">Users</option>';
    checkports($config["ports"]);
    foreach ($config["ports"] as $port) {
        $ts3 = TeamSpeak3::factory("serverquery://" . $config["username"] . ":" . $config["password"] . "@" . $config["ip"] . ":" . $config["qPort"] . "/?server_port=" . $port . "&nickname=" . $config["nickname"] . "");
        $arr_ClientList = $ts3->clientList(array("client_type" => 0));
        foreach ($arr_ClientList as $client) {
            $comboboxValues = $comboboxValues . '<option value="' . $client['client_unique_identifier'] . '|||' . htmlspecialchars($client['client_nickname']) . '">' . htmlspecialchars($client['client_nickname']) . ' (' . $client['client_unique_identifier'] . ')</option>';
        }
        $ts3 = null;
    }
    echo '<select id="names">';
    echo $comboboxValues;
    echo "</select><br>";
} catch (TeamSpeak3_Exception $error) {
    echo "Error " . $error->getCode() . ": " . $error->getMessage() . "<br><br>" . $error . "<br><br>";
}
?>
<br><input type="password" id="password" placeholder="Debug Password"><br>
<button id="add_group" style="margin-bottom:50px">Add to group</button><br>
<span id="error"></span>
<script>
    $("#add_group").click(function () {
        /* Ajax call script add UID to group for test */
        var user = $('#names').find(":selected").val();
        $.ajax({
            type: "POST",
            url: "testconnB.php",
            data: "user=" + user + "&password=" + $('#password').val(),
            success: function (text) {
                $('#error').html(text);
            },
            error: function () {
                $('#error').html("Couldn't perform ajax call");
            }
        });
    });
</script>

</body>
</html>