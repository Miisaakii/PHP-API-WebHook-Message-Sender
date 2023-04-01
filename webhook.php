<?php

//usage exemple: https://yourwebsite.com/webhook.php?details=sendWebhook&url=https://discord.com/api/webhooks&avatar=https://i.imgur.com/5Nxz3DJ.jpeg&username=Misaki&message=Welcome

$discord = new Discord();

switch($_GET["details"])
{
    case "sendWebhook":
        $r = $discord->sendWebhook($_GET["url"], $_GET["avatar"], $_GET["username"], $_GET["message"]);
        break;
    default:
    $r = "Made by Misaki#9446";
}
echo $r;

class Discord
{
    public function sendWebhook($url, $avatar, $username, $message)
    {
        $timestamp = date("c", strtotime("now"));
        $json_data = json_encode([ "content" => $message, "username" => $username, "avatar_url" => $avatar ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $ch );
        curl_close( $ch );
    }
}
?>