<?php
include '../essentials.php';
include '../db_config.php';
adminLogin();

if(isset($_POST['get_general_data'])) {
    $query = "SELECT * FROM `settings` WHERE `id_no`=?";
    $values = [1];
    $res = select($query, $values, "i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}
?>
