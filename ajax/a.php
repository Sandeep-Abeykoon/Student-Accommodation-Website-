<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

if (isset($_POST['action']) && $_POST['action'] === 'accept') {
    $accommodation_id = $_POST['id_no'];

    $query = "UPDATE `accommodations` SET `status` = 1 WHERE `id_no` = ?";
    $values = [$accommodation_id];
    $res = update($query, $values, 'i');

    echo $res;
}
