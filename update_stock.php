<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';

if(isset($_POST['ok'])) 
{
	$bkcode=$_POST['code'];
	$bkstk1=$_POST['stk'];
	$bkstk2=$_POST['upd'];
	$updatestock=$bkstk1+$bkstk2;
	
	$sql1 = "UPDATE `book` SET stock='$updatestock' WHERE bookcode='$bkcode'";
    $run1 = mysqli_query($con, $sql1);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Library Management</title>
<link rel="stylesheet" href="CSS/form_page.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,800|Lato:300,400,700,400italic,900' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="body1">
  <?php
    require 'dropdown.php';
  ?>
</div>

<div class="body2">
  <div class="body2_head">
    <h2 class="body2_head1"><i class="fas fa-books"></i>&ensp;Library Management System</h2>
    <div class="user">
      <img src="Image/user.jpg" class="user-img" id="user-img" onclick="show()" />
      <div class="user-details" id="user-detailsid">
        <div class="user-arrow-span"><i class="fas fa-triangle" id="user-arrow"></i></div>
        <div class="user-menu">
          <center><img class="user-icon" src="Image/user.jpg" /></center>
          <a href="Login/logout.php"><i class="fas fa-sign-out-alt"></i>&emsp;Logout</a>
        </div>
      </div>
    </div>
  </div>
  
  <hr />
  
  <div class="main-form">
    <div class="head">
      <p class="head-para"><i class="fas fa-layer-plus"></i>&ensp;STOCK UPDATE</p>
    </div>
    
    <hr class="h1" />
    
    <form action="#" method="post" enctype="multipart/form-data">
      <div class="container-50">
        <div class="type1-2">
          <label for="bookno">Book Code :&ensp;</label>
          <input type="text" name="bookno" class="bookno" id="bookno" value="BK" style="width: 150px;display: inline;"/>&emsp;
          <input type="submit" name="search" class="search" id="search" value="Search" />
        </div>
      </div>
    </form>
      
  <?php
    if(isset($_POST['search'])) 
	{
		$bkcode=$_POST['bookno'];
		$bkname="";
		$aut="";
		$publ="";
		$stck="";
		$sql = "SELECT * FROM `book` WHERE bookcode='$bkcode'";
		$run = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($run))
	    {
			$bkname=$row['bookname'];
			$aut=$row['author'];
		    $publ=$row['publisher'];
		    $stck=$row['stock'];
		}
  ?>
  
    <form action="#" method="post" enctype="multipart/form-data" onsubmit="message();">
      <p class="para">Book Details</p>
      
      <div class="container-100">
        <div class="type2">
          <label for="name">Book Name :</label>
          <input type="text" name="name" class="name" id="name" value="<?php echo $bkname; ?>" readonly />
        </div>
       
        <div class="type2">
          <label for="code">Book Code :</label>
          <input type="text" name="code" class="code" id="code" value="<?php echo $bkcode; ?>" readonly />
        </div>
      
        <div class="type2">
          <label for="aname">Author :</label>
          <input type="text" name="aname" class="aname" id="aname" value="<?php echo $aut; ?>" readonly />
        </div>
      </div>
      
      <div class="container-100">
        <div class="type2">
          <label for="pub">Publisher :</label>
          <input type="text" name="pub" class="pub" id="pub" value="<?php echo $publ; ?>" readonly />
        </div>
        
        <div class="type2">
          <label for="stk">Stock :</label>
          <input type="number" name="stk" class="stk" id="stk" value="<?php echo $stck; ?>" readonly />
        </div>
      
        <div class="type2"></div>
      </div>
      
      <p class="para">Update Stock</p>
      
      <div class="type2">
        <label for="upd">Stock :</label>
        <input type="number" name="upd" class="upd" id="upd" />
      </div>
      
      <div class="type2"></div>
      <div class="type2"></div>
        
      <div class="button-div">
          <input type="submit" name="ok" class="ok" id="ok" value="Submit" /> 
      </div>
    </form>
    
  <?php
	}
  ?>
  </div>
</div>

<script type="text/javascript">
var dropimg = document.getElementsByClassName("user-img");
var modal = document.getElementById("user-detailsid");
var i;

for (i = 0; i < dropimg.length; i++) {
  dropimg[i].addEventListener("click", function() {
  this.classList.toggle("drop");
  var dropdown = this.nextElementSibling;
  if (dropdown.style.display === "block") {
  dropdown.style.display = "none";
  } else {
  dropdown.style.display = "block";
  }
  });
}

window.onclick = function(event) {
	if(event.target == modal) {
		modal.style.display = "none";
	}
}
</script>

<script type="text/javascript">
function message() {
	alert("Data Recorded");
}
</script>
</body>
</html>
