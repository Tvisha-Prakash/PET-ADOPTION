<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Check the user's credentials against the database
    // Example database connection (replace with your own details):
    $db = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user["password"])) {
        // Successful login
        session_start();
        $_SESSION["user_id"] = $user["id"]; // Store user ID in the session
        header("Location: dashboard.html"); // Redirect to the user's dashboard
    } else {
        // Invalid login, show an error message
        header("Location: login.html?error=1");
    }
}
?>
