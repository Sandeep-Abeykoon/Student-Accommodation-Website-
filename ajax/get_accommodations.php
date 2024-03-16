<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

$sql = "SELECT * FROM accommodations WHERE status = ?";
$values = [1];
$data_types = 'i'; 

$result = select($sql, $values, $data_types);

while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}

mysqli_free_result($result);
