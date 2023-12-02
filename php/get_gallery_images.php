<?php
include 'db.php';

$galleryImages = fetchData("SELECT * FROM gallery_images");

echo json_encode($galleryImages);

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
