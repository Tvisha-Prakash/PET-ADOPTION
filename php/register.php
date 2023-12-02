<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $mobile = $_POST["mobile"];
    $email = $_POST["Email"];
    $password = password_hash($_POST["Password"], PASSWORD_BCRYPT); // Hash the password
    
    $db = new PDO("mysql:host=localhost;dbname=petadoption", "root", "");

    $checkSql = "SELECT COUNT(*) FROM registration WHERE Email = ?";
    $checkStmt = $db->prepare($checkSql);
    $checkStmt->execute([$email]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "Email already exists. Please use a different email.";
    } else {
        $sql = "INSERT INTO registration (Name, Username, Mobile, Email, Password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $username, $mobile, $email, $password]);
        header("Location: login.html");
    }
}
?>
