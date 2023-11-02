<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $captcha = $_POST["captcha"];
    
    $db = mysqli_connect("localhost", "root", "", "petadoption");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $checkSql = "SELECT Email, Password FROM registration WHERE Email = ?";
    $checkStmt = mysqli_prepare($db, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "s", $email);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);
     
    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        mysqli_stmt_bind_result($checkStmt, $dbEmail, $dbPassword);
        mysqli_stmt_fetch($checkStmt);
        $dbPassword = password_hash($dbPassword, PASSWORD_BCRYPT);
      
        if (password_verify($password, $dbPassword)) {
          
            header("Location: dashboard.html");
            exit;
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "Email not found. Please register or try again.";
    }

    mysqli_close($db);
}

?>
