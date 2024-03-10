<?php
include '../essentials.php';
include '../db_config.php';
adminLogin();

if (isset($_POST['get_general_data'])) {
    $query = "SELECT * FROM `settings` WHERE `id_no`=?";
    $values = [1];
    $res = select($query, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['update_general_data'])) {
    $form_data = filteration($_POST);
    $query = "UPDATE `settings` SET `site_title`=?, `site_about`=? WHERE `id_no`=?";
    $values = [$form_data['site_title'], $form_data['site_about'], 1];
    $res = update($query, $values, 'ssi');
    echo $res;
}
