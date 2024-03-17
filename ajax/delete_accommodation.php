<?php
include '../admin/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_no']) && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id_no = $_POST['id_no'];

    // Prepare the DELETE query
    $query = "DELETE FROM accommodations WHERE id_no = ?";
    $values = [$id_no];

    // Delete the accommodation
    $result = delete($query, $values, 'i');

    if ($result === 1) {
        echo 1; 
    } else {
        echo 0; 
    }
} else {
    echo 0; 
}
?>
