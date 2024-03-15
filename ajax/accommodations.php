<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

if (isset($_POST['add_accommodation'])) {
    $form_data = filteration($_POST);
    $name = $form_data['name'];
    $description = $form_data['description'];
    $location = $form_data['location'];
    $address = $form_data['address'];
    $thumbnail = $form_data['thumbnail'];
    $images = $form_data['images'];
    $bathrooms = $form_data['bathrooms'];
    $kitchens = $form_data['kitchens'];
    $rooms = $form_data['rooms'];
    $beds = $form_data['beds'];
    $price = $form_data['price'];
    $capacity = $form_data['capacity'];

    $thumbnailName = uploadImage($thumbnail, '');
    $imageNames = [];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $imageNames[] = uploadImage(['tmp_name' => $tmp_name, 'name' => $images['name'][$key]], '');
    }

    // Store accommodation details in the database
    // Your database connection code here
    // Insert accommodation details into the database
    // Your SQL query here

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}


function uploadImage($file)
{
    $target_dir = __DIR__ . '/uploads/';
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $imageFileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $uniqueName = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $uniqueName;

    // Check if the 'size' key exists in the $_FILES array
    if (isset($file['size']) && $file['size'] > 0) {
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            return null;
        }

        if ($file['size'] > 5000000) {
            return null;
        }
    }

    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        return null;
    }

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $uniqueName;
    } else {
        return null;
    }
}
