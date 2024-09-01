<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';

if(isset($_POST['ok'])) 
{
	$adm_no=$_POST['admnum'];
	$bkcode=$_POST['code'];
	$sql1 = "INSERT INTO `issue`(`admission_no`,`bookcode`,`status`) VALUES ('$adm_no','$bkcode','1')";
    $run1 = mysqli_query($con, $sql1);
	
	$sql2 = "SELECT stock FROM `book` WHERE bookcode='$bkcode'";
    $run2 = mysqli_query($con, $sql2);
	while($row2 = mysqli_fetch_assoc($run2))
	{
		$stnumber=$row2['stock'];
	}
	$stnumber=$stnumber-1;
	
	$sql3 = "UPDATE `book` SET stock='$stnumber' WHERE bookcode='$bkcode'";
    $run3 = mysqli_query($con, $sql3);
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
      <p class="head-para"><i class="fas fa-book-reader"></i>&ensp;ISSUE BOOK</p>
    </div>
    
    <hr class="h1" />
    
    <form action="#" method="post" enctype="multipart/form-data">
      <div class="container-50">
        <div class="type1-2">
          <label for="admno">Admission No. :&ensp;</label>
          <input type="number" name="admno" class="admno" id="admno" />&emsp;
          <input type="submit" name="search" class="search" id="search" value="Search" />
        </div>
      </div>
    </form>
      
  <?php
    if(isset($_POST['search'])) 
	{
		$adnum=$_POST['admno'];
		$stname="";
		$clss="";
		$mob="";
		$fname="";
		$mname="";
		$sql = "SELECT * FROM `student` WHERE admission_no=$adnum";
		$run = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($run))
	    {
			$stname=$row['studentname'];
			$clss=$row['class'];
		    $mob=$row['mobile'];
		    $fname=$row['fathername'];
		    $mname=$row['mothername'];
		}
  ?>
  
    <form action="#" method="post" enctype="multipart/form-data" onsubmit="message();">
	  <p class="para">Student Details</p>
			 
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
      
      <p class="para">Book Details</p>
      
      <div class="container-100">
        <div class="type2">
          <label for="bname">Book Name :</label>
          <select name="bname" class="cls" id="bname">
            <option value="" disabled selected hidden>Choose Book</option>
            <?php
		      $query = "SELECT bookname FROM `book`";
		      $y = mysqli_query($con, $query);
		      while($res = mysqli_fetch_assoc($y))
	          {
				  echo '<option>'.$res['bookname'].'</option>';
			  }
		    ?>
          </select>
        </div>
       
        <div class="type2">
          <label for="code">Book Code :</label>
          <input type="text" name="code" class="code" id="code" readonly />
        </div>
      
        <div class="type2">
          <label for="aname">Author :</label>
          <input type="text" name="aname" class="aname" id="aname" readonly />
        </div>
      </div>
      
      <div class="container-100">
        <div class="type2">
          <label for="pub">Publisher :</label>
          <input type="text" name="pub" class="pub" id="pub" readonly />
        </div>
        
        <div class="type2">
          <label for="stk">Stock :</label>
          <input type="number" name="stk" class="stk" id="stk" readonly />
        </div>
      
        <div class="type2"></div>
      </div>
      
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
