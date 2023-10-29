<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password
    
    // Store user information in the database (you'll need to set up your database connection)
    // Example database connection (replace with your own details):
    $db = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
    
    // Insert user data into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username, $email, $password]);
    
    // Redirect to a thank you page or login page
    header("Location: thank_you.html");
}
$recaptchaSecretKey = "6Lfe2dsoAAAAANptepBPd8j9gdDUeIn3opSOg3Sd";
$recaptchaResponse = $_POST["g-recaptcha-response"];
$remoteIp = $_SERVER["REMOTE_ADDR"];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse&remoteip=$remoteIp");
$responseKeys = json_decode($response, true);

if (intval($responseKeys["success"]) !== 1) {
    // CAPTCHA verification failed, handle accordingly
    echo "CAPTCHA verification failed.";
    // You may want to redirect back to the form with an error message.
} else {
    // CAPTCHA verification passed, continue with your registration or login process.
    // Insert user data into the database or authenticate the user as needed.
}
?>
