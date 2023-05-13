<?php

$hostname   = "localhost";
$user       = "root";
$password   = null;
$database   = "biblioteca";

try {
    $con = mysqli_connect($hostname, $user, $password, $database);
} catch (\Throwable $e) {
    print $e->getMessage();
}