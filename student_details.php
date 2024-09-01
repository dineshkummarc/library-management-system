<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';
$adnum=$_GET['var'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Library Management</title>
<link rel="stylesheet" href="CSS/form_page.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,800|Lato:300,400,700,400italic,900' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#bname").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
		$.ajax
		({
			type: "POST",
			url: "fetch.php",
			data: dataString,
			cache: false,
			success: function(value)
			{
				var data = value.split("@");
				$('#code').val(data[0]);
				$('#aname').val(data[1]);
				$('#pub').val(data[2]);
				$('#stk').val(data[3]);
		    }
		});
	});
});
</script>
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
      <p class="head-para"><i class="fas fa-user"></i>&ensp;STUDENT DETAILS</p>
    </div>
    
    <hr class="h1" />
      
    <?php
	  $stname="";
	  $gender="";
	  $mob="";
	  $fname="";
	  $mname="";
	  $dob="";
	  $img="";
	  $clss="";
	  $sql = "SELECT * FROM `student` WHERE admission_no=$adnum";
	  $run = mysqli_query($con, $sql);
	  while($row = mysqli_fetch_assoc($run))
	  {
		  $stname=$row['studentname'];
		  $fname=$row['fathername'];
	      $mname=$row['mothername'];
		  $dob=$row['dob'];
		  $gender=$row['gender'];
		  $mob=$row['mobile'];
		  $img=$row['image'];
	      $clss=$row['class'];
	  }
	  $dt=new DateTime($dob);
	  $newdt=date_format($dt,'d-m-Y');
    ?>
    
    <div class="img-container">
      <img src="<?php echo "Student_Image/".$img; ?>" class="st-image" />
    </div>
			 
	<div class="container-100">
      <div class="type2">
        <label for="name">Student Name :</label>
        <input type="text" name="name" class="name" id="name" value="<?php echo $stname; ?>" readonly />
      </div>
       
      <div class="type2">
        <label for="admnum">Admission No. :</label>
        <input type="text" name="admnum" class="admnum" id="admnum" style="width:50%;" value="<?php echo $adnum; ?>" readonly />
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
      
    <div class="container-100">
      <div class="type2">
        <label for="dob">Date of Birth :</label>
        <input type="text" name="dob" class="dob" id="dob" value="<?php echo $newdt; ?>" readonly />
      </div>
        
       <div class="type2">
        <label for="gender">Gender :</label>
        <input type="text" name="gender" class="gender" id="gender" value="<?php echo $gender; ?>" readonly />
      </div>
      
      <div class="type2"></div>
    </div>
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
</body>
</html>
