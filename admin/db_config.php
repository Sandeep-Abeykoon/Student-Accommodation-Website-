<?php
$hostName = 'localhost';
$username = 'root';
$password = '';
$database = 'nsbm_accomodation';

$connection = mysqli_connect($hostName, $username, $password, $database);

if (!$connection) {
    die("Cannot Connect to Database" . mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        $data[$key] = $value;
    }
    return $data;
}

function select($sql, $values = [], $data_types = '')
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        if (!empty($values)) {
            mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        }
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

function update($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - UPDATE");
        }
    } else {
        die("Query cannot be prepared - UPDATE");
    }
}

function insert($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - INSERT");
        }
    } else {
        die("Query cannot be prepared - INSERT");
    }
}

function delete($sql, $values, $data_types)
{
    $con = $GLOBALS['connection'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $data_types, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - DELETE");
        }
    } else {
        die("Query cannot be prepared - DELETE");
    }
}

function selectSingle($query, $values, $data_types)
{
    global $connection;
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, $data_types, ...$values);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return $row;
}
