<?php
$hostName = 'localhost';
$username = 'root';
$password = '';
$database = 'nsbm_accomodation';

$connection = mysqli_connect($hostName, $username, $password, $database);

if (!$connection) {
    die("Cannot Connect to Database" . mysqli_connect_error());
} else {
    echo '<script>console.log("Connected to database successfully");</script>';
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
        $data[$key] = stripslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}
