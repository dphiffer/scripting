<?php

header('Content-Type: application/json; charset=utf-8');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://en.wikipedia.org/w/api.php?action=mobileview&page={$_GET['article']}&sections=all&prop=text&format=json");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
