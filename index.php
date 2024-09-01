<?php
session_start();
if($_SESSION['Status']!="Active") {
	header("Location: Login/login_page.php");
}
$usid=$_SESSION['userid'];

require 'connect.php';

$row_count1="SELECT 'admission_no' FROM `student`";
$run1=mysqli_query($con, $row_count1);
$row1=mysqli_num_rows($run1);

$row_count2="SELECT 'bookcode' FROM `book`";
$run2=mysqli_query($con, $row_count2);
$row2=mysqli_num_rows($run2);

$row_count3="SELECT 'admission_no' FROM `issue`";
$run3=mysqli_query($con, $row_count3);
$row3=mysqli_num_rows($run3);

$row_count4="SELECT 'admission_no' FROM `return`";
$run4=mysqli_query($con, $row_count4);
$row4=mysqli_num_rows($run4);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Library Management</title>
<link rel="stylesheet" href="CSS/index.css" />
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
  
    <div class="container">
      <a href="student_list.php">
        <div class="divider">
          <div class="box" id="box1">
            <div class="box-content">
              <p class="count"><?php echo $row1; ?></p>
              <p class="box-para">Students</p>
            </div>
          </div>
        </a>
      </div>
      
      <div class="divider">
        <a href="book_list.php">
          <div class="box" id="box2">
            <div class="box-content">
              <p class="count"><?php echo $row2; ?></p>
              <p class="box-para">Books</p>
            </div>
          </div>
        </a>
      </div>
      
      <div class="divider">
        <a href="issue_list.php">
          <div class="box" id="box3">
            <div class="box-content">
              <p class="count"><?php echo $row3; ?></p>
              <p class="box-para">Books Issued</p>
            </div>
          </div>
        </a>
      </div>
      
      <div class="divider">
        <a href="return_list.php">
          <div class="box" id="box4">
            <div class="box-content">
              <p class="count"><?php echo $row4; ?></p>
              <p class="box-para">Books Returned</p>
            </div>
          </div>
        </a>
      </div>
    </div>
    
    <div class="main-div">
    <div class="head">
      <p class="head-para"><i class="fas fa-book"></i>&ensp;ISSUED LIST</p>
    </div>
    
    <hr class="h1" />
    
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
    
    <table class="my-table" id="my-table" border="0">
      <thead>
        <tr>
          <th style="width: 42px;">S.No.</th>
          <th>Admission No.</th>
          <th>Student Name</th>
          <th>Book Name</th>
          <th>Book Code</th>
          <th style="width: 85px;">Issue Date</th>
        </tr>
      </thead>
        
      <tbody>
        <?php
            $sno=0;
		    $sql = "SELECT student.studentname,book.bookname,issue.admission_no,issue.bookcode,issue.doc FROM `student`,`book`,`issue` WHERE issue.admission_no=student.admission_no AND issue.bookcode=book.bookcode AND issue.status=1";
		    $run = mysqli_query($con, $sql);
		    while($row = mysqli_fetch_assoc($run))
		    {
				$sno = $sno+1;
				$datestore = $row['doc'];
    			$newvar = new DateTime($datestore);
	    		$ndate = $newvar->format('d-m-Y');
				
  	  		    echo '<tr>';
	  		      echo '<td>'.$sno.'</td>';
				  echo '<td>'.$row['admission_no'].'</td>';
    		      echo '<td>'.$row['studentname'].'</td>';
    		      echo '<td>'.$row['bookname'].'</td>';
				  echo '<td>'.$row['bookcode'].'</td>';
				  echo '<td>'.$ndate.'</td>';
		   	    echo '</tr>'; 
		    }
	    ?>
      </tbody>
    </table>
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
    td = tr[i].getElementsByTagName("td")[1];
    td1 = tr[i].getElementsByTagName("td")[2];
	td2 = tr[i].getElementsByTagName("td")[3];
    td3 = tr[i].getElementsByTagName("td")[4];
	td4 = tr[i].getElementsByTagName("td")[5];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if ((txtValue.toUpperCase().indexOf(filter) > -1) || (td1.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1) || (td4.innerHTML.toUpperCase().indexOf(filter) > -1)) {
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
