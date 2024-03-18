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

// Create tables if they don't exist
$create_tables_query = "
CREATE TABLE IF NOT EXISTS `accommodations` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `address` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `kitchens` int(11) NOT NULL,
  `rooms` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `message` varchar(200) DEFAULT NULL,
  `lon` varchar(250) NOT NULL,
  `lat` varchar(250) NOT NULL,
  `uid` int(11) NOT NULL,
  `reserved` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_no`),
  KEY `uid` (`uid`)
);

CREATE TABLE IF NOT EXISTS `accommodation_images` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `accommodation_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id_no`),
  KEY `accommodation_id` (`accommodation_id`),
  CONSTRAINT `accommodation_images_ibfk_1` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id_no`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `admin_credentials` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_no`)
);

CREATE TABLE IF NOT EXISTS `articles` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(100) NOT NULL,
  `article_content` varchar(500) NOT NULL,
  PRIMARY KEY (`id_no`)
);

CREATE TABLE IF NOT EXISTS `bookings` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `accommodation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_no`),
  KEY `accommodation_id` (`accommodation_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id_no`) ON DELETE CASCADE,
  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_no`) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `users` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`id_no`)
);
";

mysqli_multi_query($connection, $create_tables_query);

while (mysqli_next_result($connection)) {
    if (!mysqli_more_results($connection)) {
        break;
    }
}
