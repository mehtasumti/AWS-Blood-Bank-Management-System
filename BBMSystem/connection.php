<?php
$db_host = 'ec2-34-239-118-67.compute-1.amazonaws.com'; 
$db_username = 'root';
$db_password = 'K21academy.com';
$db_name = 'bloodbankdb';

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>