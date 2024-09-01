<?php
session_start();
require '../connect.php';

$msg="";
if($_SERVER["REQUEST_METHOD"]=="POST") {
	
	$id = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM user WHERE `UserID`='$id' AND `Password`='$pass'";
    $run = mysqli_query($con, $sql) ;
    $rows = mysqli_num_rows($run);
	if($rows>0) {
		$_SESSION['userid'] = $id;
		$_SESSION['Status'] = "Active";
		header("Location: ../index.php");
	}
	else {
		$msg = "* Invalid Username or Password";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="CSS/login_page.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,800|Lato:300,400,700,400italic,900' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="main-div">
  <div class="content-div">
    <div class="content-div2">
      <center><img src="Image/admin.jpg" class="user-img" id="user-img" /></center>
      <p class="heading">LOGIN</p>
      <hr class="hr1" />
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="container">
          <label for="username">Username</label>
          <input type="text" name="username" class="username" id="username" placeholder="Username" required />&ensp;<i class="fas fa-user"></i>
        </div>
       
        <div class="container">
          <label for="password">Password</label>
          <input type="password" name="password" class="password" id="password" placeholder="Password" required />&ensp;<i class="fas fa-lock-alt"></i>
        </div>
      
        <span class="invalid" id="invalid"><?php echo $msg; ?></span>
      
        <div class="button-container">
          <input type="submit" name="ok" class="ok" id="ok" value="Login" />
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>