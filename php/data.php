<?php
include 'db.php';

$featuredPets = fetchData("SELECT * FROM featured_pets");
$recentImages = fetchData("SELECT * FROM recent_images");
$recentComments = fetchData("SELECT * FROM recent_comments");

$data = [
    'featuredPets' => $featuredPets,
    'recentImages' => $recentImages,
    'recentComments' => $recentComments,
];

echo json_encode($data);

$conn->close();

function fetchData($sql) {
    global $conn;
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}
?>
