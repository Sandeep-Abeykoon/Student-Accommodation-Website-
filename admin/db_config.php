<?php
$hostName = 'localhost';
$username = 'root';
$password = '';
$database = 'nsbm_accomodation';

$connection = mysqli_connect($hostName, $username, $password, $database);

if (!$connection) {
    die("Cannot Connect to Database" . mysqli_connect_error());
}
?>