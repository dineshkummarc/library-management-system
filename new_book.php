<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';

if(isset($_POST['ok'])) 
{
	$bname=$_POST['name'];
	$bcode = $_POST['code'];
	$aut = $_POST['aname'];
	$publish = $_POST['pub'];
	$stck = $_POST['stk'];
	
	$sql = "INSERT INTO `book`(`bookname`,`bookcode`,`author`,`publisher`,`stock`) VALUES('$bname','$bcode','$aut','$publish','$stck')";
	$run = mysqli_query($con, $sql);
	
	$bknum=$_POST['bknum'];
	$bknum=$bknum+1;
	$query = "UPDATE `book_code` SET bookcode='$bknum'";
	$x = mysqli_query($con, $query);
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
      <img src="Image/user.jpg" class="user-img" id="user-img" />
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
      <p class="head-para"><i class="fas fa-book"></i>&ensp;NEW BOOK</p>
    </div>
    
    <hr class="h1" />
    
    <?php
	  $bno="";
	  $sql1 = "SELECT * FROM `book_code`";
	  $run1 = mysqli_query($con, $sql1);
	  while($row1 = mysqli_fetch_assoc($run1))
	  {
		  $bno=$row1['bookcode'];
	  }
	  $bkcode='BK'.$bno;
	?>
    
    <form action="#" method="post" enctype="multipart/form-data" onsubmit="message();">
      <div class="container-100">
        <div class="type2">
          <label for="name">Book Name :</label>
          <input type="text" name="name" class="name" id="name" />
        </div>
        
        <div class="type2">
          <label for="code">Book Code :</label>
          <input type="text" name="code" class="code" id="code" value="<?php echo $bkcode; ?>" readonly />
        </div>
      
        <div class="type2">
          <label for="aname">Author :</label>
          <input type="text" name="aname" class="aname" id="aname" />
        </div>
      </div>
      
      <div class="container-100">
        <div class="type2">
          <label for="pub">Publisher :</label>
          <input type="text" name="pub" class="pub" id="pub" />
        </div>
        
        <div class="type2">
          <label for="stk">Stock :</label>
          <input type="number" name="stk" class="stk" id="stk" />
        </div>
      
        <div class="type2"></div>
      </div>
      
      <div class="button-div">
          <input type="submit" name="ok" class="ok" id="ok" value="Submit" /> 
      </div>
      
      <input type="text" name="bknum" id="bknum" class="bknum" value="<?php echo $bno; ?>" style="display:none;" />
    </form>
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
