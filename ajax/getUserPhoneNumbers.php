<?php
function selectUserPhoneNumbers($userId)
{
    $sql = "SELECT phone_number, secondary_phone_number FROM users WHERE id_no = ?";
    $values = [$userId];
    $data_types = 'i'; 

    $result = select($sql, $values, $data_types);
    return $result->fetch_assoc(); 
}
