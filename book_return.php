<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';
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
      
      <p class="para">Issued Books</p>
      
      <table class="my-table" border="1">
        <thead>
          <tr>
            <th style="width: 42px;">S.No.</th>
            <th>Book Name</th>
            <th>Book Code</th>
            <th>Issue Date</th>
            <th style="width: 20px;"">Action</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
            $sno=0;
			$sql1= "";
		    $sql1 = "SELECT book.bookname,issue.bookcode,issue.doc FROM`book`,`issue` WHERE issue.admission_no=$adnum AND issue.bookcode=book.bookcode && issue.status='1'";
		    $run1 = mysqli_query($con, $sql1);
		    while($res = mysqli_fetch_assoc($run1))
		    {
				$sno = $sno+1;
				$datestore = $res['doc'];
    			$newvar = new DateTime($datestore);
	    		$ndate = $newvar->format('d-m-Y');
  	  		    echo '<tr>';
	  		      echo '<td>'.$sno.'</td>';
    		      echo '<td>'.$res['bookname'].'</td>';
				  echo '<td>'.$res['bookcode'].'</td>';
    		      echo '<td>'.$ndate.'</td>';
				  echo '<td><a href="book_return_details.php?var1='.$adnum.' && var2='.$res['bookcode'].'" style="font-size: 18px;">Return</a></td>';
		   	    echo '</tr>'; 
		    }
		  ?>
        </tbody>
      </table>
  
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
