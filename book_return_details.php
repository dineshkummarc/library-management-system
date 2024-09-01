<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';
$adm = $_GET['var1'];
$bcod = $_GET['var2'];
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
      <p class="head-para"><i class="fas fa-book-reader"></i>&ensp;RETURN BOOK</p>
    </div>
    
    <hr class="h1" />
  
  <?php
    $stname="";
    $clss="";
	$mob="";
	$fname="";
	$mname="";
	$sql = "SELECT * FROM `student` WHERE admission_no=$adm";
	$run = mysqli_query($con, $sql);
	while($row = mysqli_fetch_assoc($run))
    {
		$stname=$row['studentname'];
		$clss=$row['class'];
	    $mob=$row['mobile'];
	    $fname=$row['fathername'];
	    $mname=$row['mothername'];
	}
	
	$bkname="";
    $bkcode="";
	$bkpub="";
	$bkaut="";
	$datestore="";
	$sql1 = "SELECT *,issue.bookcode,issue.doc FROM `book`,`issue` WHERE issue.bookcode='$bcod' && book.bookcode='$bcod'";
	$run1 = mysqli_query($con, $sql1);
	while($res = mysqli_fetch_assoc($run1))
    {
		$bkname=$res['bookname'];
        $bkcode=$res['bookcode'];
		$bkpub=$res['publisher'];
	    $bkaut=$res['author'];
	    $datestore=$res['doc'];
	}
	$newvar = new DateTime($datestore);
	$ndate = $newvar->format('d-m-Y');
	
	$add=30;
	$ndt = date('d-m-Y',strtotime($ndate.'+ '.$add.' days'));
	$new = new DateTime($ndt);
	
	$currdt = date('d-m-Y');
	$newcurr = new DateTime($currdt);
	
	$diff = date_diff($new,$newcurr);
	$fine_form = $diff->format("%R%a");
	if($fine_form<=0) 
	{
		$fine=0;
	}
	else 
	{
		$fine=$fine_form*3;
	}
  ?>
      
    <form action="book_return_calculation.php" method="post" enctype="multipart/form-data" onsubmit="message();">
      <p class="para">Student Details</p>
      
      <div class="container-100">
        <div class="type2">
          <label for="name">Student Name :</label>
          <input type="text" name="name" class="name" id="name" value="<?php echo $stname; ?>" readonly />
        </div>
       
        <div class="type2">
          <label for="admnum">Admission No. :</label>
          <input type="text" name="admnum" class="admnum" id="admnum" style="width:50%;" value="<?php echo $adm; ?>" readonly />
        </div>
        
        <div class="type2">
          <label for="class">Class :</label>
          <input type="text" name="class" class="class" id="class" value="<?php echo $clss; ?>" readonly />
        </div>
      </div>
      
      <div class="container-100">
        <div class="type2">
          <label for="mob">Mobile :</label>
          <input type="text" name="mob" class="mob" id="mob" value="<?php echo $mob; ?>" readonly />
        </div>
        
        <div class="type2">
          <label for="fname">Father&rsquo;s Name :</label>
          <input type="text" name="fname" class="fname" id="fname" value="<?php echo $fname; ?>" readonly />
        </div>
      
        <div class="type2">
          <label for="mname">Mother&rsquo;s Name :</label>
          <input type="text" name="mname" class="mname" id="mname" value="<?php echo $mname; ?>" readonly />
        </div>
      </div>
      
      <p class="para">Book Details</p>
      
      <div class="container-100">
        <div class="type2">
          <label for="bname">Book Name :</label>
          <input type="text" name="bname" class="bname" id="bname" value="<?php echo $bkname; ?>" readonly />
        </div>
       
        <div class="type2">
          <label for="bcode">Book Code :</label>
          <input type="text" name="bcode" class="bcode" id="bcode" value="<?php echo $bkcode; ?>" readonly />
        </div>
        
        <div class="type2">
          <label for="aut">Author :</label>
          <input type="text" name="aut" class="aut" id="aut" value="<?php echo $bkaut; ?>" readonly />
        </div>
      </div>
      
      <div class="container-100">
        <div class="type2">
          <label for="pub">Publisher :</label>
          <input type="text" name="pub" class="pub" id="pub" value="<?php echo $bkpub; ?>" readonly />
        </div>
      
        <div class="type2">
          <label for="dt">Issue Date :</label>
          <input type="text" name="dt" class="dt" id="dt" value="<?php echo $ndate; ?>" readonly />
        </div>
        
        <div class="type2">
          <label for="fine">Fine :</label>
          <input type="text" name="fine" class="fine" id="fine" value="<?php echo $fine; ?>" readonly />
        </div>
      </div>
      
      <div class="button-div">
          <input type="submit" name="ok" class="ok" id="ok" value="Return" /> 
      </div>
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
