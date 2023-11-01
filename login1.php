<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    try {
        $db = new PDO("mysql:host=localhost;dbname=petadoption", "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO login1 (uerrname,password) VALUES (?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username,$password]);

        header("Location: login.html"); // Redirect to the login page
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
