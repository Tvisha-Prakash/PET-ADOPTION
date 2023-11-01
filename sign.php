<!doctype html>
<?php require_once("config.php");?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style3.css">
  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="col-4">
        </div>
        <div class="col-4">
<img src="https://tse1.mm.bing.net/th?id=OIP.v5EeUST4alPtoyYTmmjVRAHaC4&pid=Api&P=0&h=180" alt="TravelBits" class="logo img-fluid">
</div>   
<div class="col-4">
        </div>
    </div>
</div>
<div class="row">
  <?php
  if(isset($_POST['signup']))
  {
    extract($_POST);
    if(strlen($fname)<3){
      $error[]='Please enter first name using 3 characters atleast';
    }
    if(strlen($fname)>20){
      $error[]='First Name:Max length 20 characters not allowed';
    }
    if(!preg_match("/^[A-Za-z _][A-Za-z ]+[A-Za-z _]$/",$fname)){
      $error[]='Invalid first name.Please enter letters without digits or special symbols like(1,2,3,#,$,%,^,-,)';
      
    }
    if(strlen($lname)<3){
      $error[]='Please enter last name using 3 characters atleast';
    }
    if(strlen($lname)>20){
      $error[]='last Name:Max length 20 characters not allowed';
    }
    if(!preg_match("/^[A-Za-z _][A-Za-z ]+[A-Za-z _]$/",$lname)){
      $error[]='Invalid last name.Please enter letters without digits or special symbols like(1,2,3,#,$,%,^,-,)';
      
    }
    if(strlen($username)<3){
      $error[]='Please enter first name using 3 characters atleast';
    }
    if(strlen($username)>20){
      $error[]='user Name:Max length 20 characters not allowed';
    }
    if(!preg_match("/^^[^0-9][a-z0-9]+([_ -]?[a-z0-9])*$/",$username)){
      $error[]='Invalid user name';
    }
    if($passwordConfirm == ''){
      $error[]='please confirm the password';
    }if($password != $passwordConfirm){
      $error[]='passwords donot match';
    }if(strlen($password)<8){
      $error[]='password must be atleast 8 characters long';
    }
    $sql="select * from users where(username='$username' or email='$email');";
    $res=mysqli_query($dbc,$sql);
    if(mysqli_num_rows($res)>0){
      $row=mysqli_fetch_assoc($res);
      if($username==$row['username']){
        $error[]='username already exists';
      }if($email==$row['email']){
        $error[]='email already exists';
      }
    }
    if(!isset($error)){
      $date=date('Y-m-d');
      $options=array("cost"=>4);
      $password=password_hash($password,PASSWORD_BCRYPT,$options);

      $result=mysqli_query($dbc,"INSERT into users values('','$fname','$lname','$username','$email','$password','$date')");
      if($result){
        $done=2;
      }else{
        $error[]='failed:something went wrong';
      }
    }
  }
  ?>
  <div class="col-4">
    <?php
    if(isset($error)){
      foreach($error as $error){
        echo '<p class="errmsg">&#x26A0;'.$error. '</p>';
      }
    }
    ?>
  </div>
  <div class="col-4">
    <?php if(isset($done)){
      ?>
      <div class="successmsg"><span style="font-size:100px;">&#9989;</span><br>
      You have registered successfully!<br><a href="loginchat.php" style="color:#fff;">Login here..</a></div>
      <?php }else { ?>
    <div class="signup_form">
      <form action="" method="POST">
        <div class="form-group">
          <label class="label_text">First Name</label>
          <input type="text" class="form-control" name="fname" required="">
        </div>
        <div class="form-group">
          <label class="label_text">Last Name</label>
          <input type="text" class="form-control" name="lname" required="">
        </div>
        <div class="form-group">
          <label class="label_text">User Name</label>
          <input type="text" class="form-control" name="username" required="">
        </div>
        <div class="form-group">
          <label class="label_text">Email</label>
          <input type="email" class="form-control" name="email" required="">
        </div>
        <div class="form-group">
          <label class="label_text">Password</label>
          <input type="password" class="form-control" name="password" required="">
        </div>
        <div class="form-group">
          <label class="label_text">Confirm Password</label>
          <input type="password" class="form-control" name="passwordConfirm" required="">
        </div>
        <button type="submit" name="signup" class="form_btn btn btn-primary">Signup</button>
       <p>Have an account? <a href="loginchat.php">Log in</a></p> 
       <?php } ?>
      </form>
    </div>
    <div class="col-4">
  </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>  
</body>
</html>