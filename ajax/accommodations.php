<?php
// include '../admin/db_config.php';
// include '../admin/essentials.php';

if (isset($_POST['add_accommodation'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $thumbnail = $_FILES['thumbnail'];
    $images = $_FILES['images'];
    $bathrooms = $_POST['bathrooms'];
    $kitchens = $_POST['kitchens'];
    $rooms = $_POST['rooms'];
    $beds = $_POST['beds'];
    $price = $_POST['price'];
    $capacity = $_POST['capacity'];

    $thumbnailName = uploadImage($thumbnail, '');
    $imageNames = [];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $imageNames[] = uploadImage(['tmp_name' => $tmp_name, 'name' => $images['name'][$key]], '');
    }

    // $uId = $_SESSION["uId"];

    // print_r($uId);

    // Insert accommodation details into the accommodations table
    $sql = "INSERT INTO accommodations (name, description, location, address, thumbnail, bathrooms, kitchens, rooms, beds, price, capacity, uId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $values = [$name, $description, $location, $address, $thumbnailName, $bathrooms, $kitchens, $rooms, $beds, $price, $capacity, 22];
    $data_types = "sssssiiiidii";
    $result = insert($sql, $values, $data_types);

    // Insert image names into the accommodation_images table
    foreach ($imageNames as $imageName) {
        $sql = "INSERT INTO accommodation_images (image_path, accommodation_id) VALUES (?, ?)";
        $values = [$imageName, 10]; // $result is the ID of the newly inserted accommodation
        $data_types = "si";
        insert($sql, $values, $data_types);
    }

    echo 'success';
} else {
    echo 'failed';
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

function getPendingAccommodations()
{
    // Check if uRole session is 'warden'
    if (isset($_SESSION['uRole']) && $_SESSION['uRole'] == 'warden') {
        $sql = "SELECT a.*, GROUP_CONCAT(ai.image_path) AS image_paths
                FROM accommodations a
                LEFT JOIN accommodation_images ai ON a.id_no = ai.accommodation_id
                WHERE a.status = '0'
                GROUP BY a.id_no";
        $result = select($sql);

        $pendingAccommodations = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $images = explode(",", $row['image_paths']);
            $pendingAccommodations[] = [
                'id_no' => $row['id_no'],
                'name' => $row['name'],
                'description' => $row['description'],
                'images' => $images
            ];
        }
        return $pendingAccommodations;
    } else {
        // Redirect to index.php and destroy session
        header("Location: index.php");
        session_destroy();
        exit();
    }
}
