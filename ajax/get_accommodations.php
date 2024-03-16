<?php
include '../admin/db_config.php';
include '../admin/essentials.php';

$sql = "SELECT * FROM accommodations WHERE status = ?";
$values = [1];
$data_types = 'i';

$result = select($sql, $values, $data_types);

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

mysqli_free_result($result);

header('Content-Type: application/json');
echo json_encode($rows);


$sql = "SELECT a.*, GROUP_CONCAT(ai.image_path) AS image_paths
                FROM accommodations a
                LEFT JOIN accommodation_images ai ON a.id_no = ai.accommodation_id
                WHERE a.status = 1
                GROUP BY a.id_no";
$result = select($sql);

$accommodations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $images = explode(",", $row['image_paths']);
    $accommodations[] = [
        'id_no' => $row['id_no'],
        'name' => $row['name'],
        'description' => $row['description'],
        'location' => $row['location'],
        'address' => $row['address'],
        'thumbnail' => $row['thumbnail'],
        'bathrooms' => $row['bathrooms'],
        'kitchens' => $row['kitchens'],
        'rooms' => $row['rooms'],
        'beds' => $row['beds'],
        'price' => $row['price'],
        'capacity' => $row['capacity'],
        'uId' => $row['uid'],
        'images' => $images
    ];
}
return $accommodations;
