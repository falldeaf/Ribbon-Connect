<?php
$url = $_POST['rurl'];

echo $url . "\n\n";

//rovio user and pass:
$username = "";
$password = "";

$context = stream_context_create(array(
    'http' => array(
        'header'  => "Authorization: Basic " . base64_encode("$username:$password")
    )
));
$data = file_get_contents($url, false, $context);
echo $data;
?>