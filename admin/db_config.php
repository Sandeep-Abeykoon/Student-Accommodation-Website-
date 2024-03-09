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

function select($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - SELECT");
        }
    } else {
        die("Query cannot be prepared - SELECT");
    }
}
