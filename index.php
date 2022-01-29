<?php
$url = 'https://www.toptal.com/developers/cssminifier/raw';

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ["Content-Type: application/x-www-form-urlencoded"],
        CURLOPT_POSTFIELDS => http_build_query([ "input" => "input=p { color : red; }" ])
    ]);

    $minified = curl_exec($ch);

    curl_close($ch);

    echo $minified;
?>
