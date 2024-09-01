<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';

if(isset($_POST['ok'])) 
{
	$adm=$_POST['admno'];
	$sname = $_POST['name'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$db = $_POST['dob'];
	$gend = $_POST['gender'];
	
	if(is_uploaded_file($_FILES['img']['tmp_name']))
	{
		$source = $_FILES['img']['tmp_name'];
		$img_name = $adm.".jpg";
		$destination = "Student_Image/".$img_name;
		
		if(move_uploaded_file($source, $destination)) {
		}
	}
	$mb = $_POST['mob'];
	$adm_class = $_POST['cls'];
	
	$sql = "INSERT INTO `student`(`admission_no`,`studentname`,`fathername`,`mothername`,`dob`,`gender`,`mobile`,`image`,`class`) VALUES('$adm','$sname','$fname','$mname','$db','$gend','$mb','$img_name','$adm_class')";
	$run = mysqli_query($con, $sql);
	
	$admnum=$adm+1;
	$query = "UPDATE `admission_number` SET `adm_no`='$admnum'";
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
      <p class="head-para"><i class="fas fa-users"></i>&ensp;NEW STUDENT</p>
    </div>
    
    <hr class="h1" />
    
    <?php
	  $adno="";
	  $sql1 = "SELECT * FROM `admission_number`";
	  $run1 = mysqli_query($con, $sql1);
	  while($row1 = mysqli_fetch_assoc($run1))
	  {
		  $adno=$row1['adm_no'];
	  }
	?>
    
    <form action="#" method="post" enctype="multipart/form-data" onsubmit="message();">
      <div class="container-50">
        <div class="type1-1">
          <label for="admno">Admission No. :&ensp;</label>
          <input type="number" name="admno" class="admno" id="admno" value="<?php echo $adno; ?>" required="required" readonly />
        </div>
      </div>
      
      <div class="container-100">
        <div class="type2">
          <label for="name">Student Name :</label>
          <input type="text" name="name" class="name" id="name" required="required" />
        </div>
        
        <div class="type2">
          <label for="fname">Father's Name :</label> 
          <input type="text" name="fname" class="fname" id="fname" required="required" />
        </div>
      
        <div class="type2">
          <label for="mname">Mother's Name :</label>
          <input type="text" name="mname" class="mname" id="mname" required="required" />
        </div>
      </div>
        
      <div class="container-100">
        <div class="type2">
          <label for="dob">Date of Birth :</label>
          <input type="date" name="dob" class="dob" id="dob" required="required" />
        </div>
      
        <div class="type2">
          <label for="gender">Gender :</label>
          <div class="radio">
            <input type="radio" name="gender" class="gender" id="gender" value="male" /> Male&emsp;
            <input type="radio" name="gender" class="gender" id="gender" value="female" /> Female&emsp;
            <input type="radio" name="gender" class="gender" id="gender" value="other" /> Other
          </div>
        </div>
        
        <div class="type2">
          <label for="img">Student's Photo :</label>
          <input type="file" name="img" class="img" id="img" required="required" />
        </div>
      </div>
      
      <div class="container">
        <div class="type2">
          <label for="mname">Mobile :</label>
          <input type="number" name="mob" class="mob" id="mob" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" required="required" />
        </div>
        
        <div class="type2">
          <label for="cls">Admission Class :</label>
          <select name="cls" class="cls" id="cls" required="required">
            <option value="" disabled selected hidden>Choose Class</option>
            <option>Nursery</option>
            <option>L.K.G.</option>
            <option>U.K.G.</option>
            <option>One</option>
            <option>Two</option>
            <option>Three</option>
            <option>Four</option>
            <option>Five</option>
            <option>Six</option>
            <option>Seven</option>
            <option>Eight</option>
            <option>Nine</option>
            <option>Ten</option>
            <option>Eleven</option>
            <option>Twelve</option>
          </select>
        </div>
        
        <div class="type2"></div>
      </div>
      
      <div class="button-div">
          <input type="submit" name="ok" class="ok" id="ok" value="Submit" /> 
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
