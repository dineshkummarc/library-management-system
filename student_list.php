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
<link rel="stylesheet" href="CSS/table_page.css" />
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
  
  <div class="main-div">
    <div class="head">
      <p class="head-para"><i class="fas fa-users"></i>&ensp;STUDENT LIST</p>
    </div>
    
    <hr class="h1" />
    
    <div class="div-content-right">
      <a href="new_student.php"><button class="button1">+ Add Student</button></a>
    </div>
    
    <div class="div-content">
      <div>
        <form action="#" method="post">
          <p class="font">Show:&ensp;
          <select class="entries" id="entries" name="entries">
            <option value="" disabled selected hidden>5</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>&ensp;entries</p>
        </form>
      </div>
      
      <div>
        <p class="font">Search:&ensp;<input type="text" id="my_input" name="search" placeholder="Search here" onkeyup="searching();" /></p>
      </div>
    </div>
      
    <form action="#" method="post" enctype="multipart/form-data">
      <table class="my-table" id="my-table" border="0">
        <thead>
          <tr>
            <th style="width: 42px;">S.No.</th>
            <th style="width: 60px;">Image</th>
            <th>Student Name</th>
            <th>Admission No.</th>
            <th>Class</th>
            <th>Mobile</th>
            <th style="width: 20px;"">Action</th>
          </tr>
        </thead>
        
        <tbody>
          <?php
            $sno=0;
		    $sql = "SELECT admission_no,studentname,image,class,mobile FROM `student`";
		    $run = mysqli_query($con, $sql);
		    while($row = mysqli_fetch_assoc($run))
		    {
				$sno = $sno+1;
			    $imgst="Student_Image/".$row['image'];
  	  		    echo '<tr>';
	  		      echo '<td>'.$sno.'</td>';
     		      echo '<td><img src='.$imgst.' class="image" id="image" /></td>';
    		      echo '<td>'.$row['studentname'].'</td>';
				  echo '<td>'.$row['admission_no'].'</td>';
    		      echo '<td>'.$row['class'].'</td>';
				  echo '<td>'.$row['mobile'].'</td>';
				  echo '<td><a href="student_details.php?var='.$row['admission_no'].'"><i class="fas fa-eye"></i></a></td>';
		   	    echo '</tr>'; 
		    }
		  ?>
        </tbody>
      </table>
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
function searching() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("my_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("my-table");
  tr = table.getElementsByTagName("tr");
  for (i=0; i<tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    td1 = tr[i].getElementsByTagName("td")[3];
	td2 = tr[i].getElementsByTagName("td")[4];
    td3 = tr[i].getElementsByTagName("td")[5];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if ((txtValue.toUpperCase().indexOf(filter) > -1) || (td1.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1)) {
        tr[i].style.display = "";
      } 
	  else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>
