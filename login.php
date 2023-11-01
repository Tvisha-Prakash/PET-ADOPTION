<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify reCAPTCHA first
    $recaptchaSecretKey = "6Lfe2dsoAAAAANptepBPd8j9gdDUeIn3opSOg3Sd";
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse
    );

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $responseKeys = json_decode($result, true);

    if (intval($responseKeys["success"]) !== 1) {
        // CAPTCHA verification failed, show an error message or redirect as needed
        header("Location: login.html?captcha_error=1");
        exit;
    }

    // If CAPTCHA verification is successful, proceed with login validation
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Create a PDO database connection
    $db = new PDO("mysql:host=localhost;dbname=petadoption", "root", "");
    
    // Check the user's credentials against the database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user["password"])) {
        // Successful login
        session_start();
        $_SESSION["user_id"] = $user["id"]; // Store user ID in the session
        header("Location: dashboard.html"); // Redirect to the user's dashboard
    } else {
        // Invalid login, show an error message or redirect
        header("Location: login.html?login_error=1");
    }
}
?>
