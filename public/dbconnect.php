<?php

//connect the database by pdo
$host = '127.0.0.1';
$user = 'teamc-iot'
$pass = 'c2asf598gg';
$dbname = 'teamc-2019summer';

$pdo = new PDO("mysql:host=$host; dbname= $dbname", $user, $pass);

?>