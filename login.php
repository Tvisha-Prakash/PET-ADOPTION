<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    
    $db = new PDO("mysql:host=localhost;dbname=petadoption", "root", "");

    $checkSql = "SELECT Email, Password FROM registration WHERE Email = ?";
    $checkStmt = $db->prepare($checkSql);
    $checkStmt->execute([$email]);
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $dbPassword = $result["Password"];
      
        if (password_verify($password, $dbPassword)) {
            header("Location: dashboard.html");
            exit;
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Email not found. Please register or try again.";
    }
}
?>
