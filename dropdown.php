<?php
require 'connect.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dropdown</title>
<link rel="stylesheet" href="CSS/dropdown.css" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,600,800|Lato:300,400,700,400italic,900' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="body1_head">
  <h1>LIBRARY</h1>
</div>

<hr />
<hr />

<div class="body1_content">
  <a href="index.php"><i id="li-img" class="fas fa-bars"></i>&emsp;&emsp; DASHBOARD</a>
    
  <button class="dropdown-btn"><i id="li-img" class="far fa-user-graduate"></i>&emsp;&emsp; STUDENT<i class="fad fa-chevron-double-right"></i></button>
      
  <div class="drop-ul">
    <a href="new_student.php"><i class="fad fa-caret-right"></i>&emsp; New Student</a>
    <a href="student_list.php"><i class="fad fa-caret-right"></i>&emsp; Student List</a>
  </div>
      
  <button class="dropdown-btn"><i id="li-img" class="far fa-book-heart"></i>&emsp;&emsp; LIBRARY<i class="fad fa-chevron-double-right"></i></button>
    
  <div class="drop-ul">
    <a href="new_book.php"><i class="fad fa-caret-right"></i>&emsp; New Book</a>
    <a href="book_list.php"><i class="fad fa-caret-right"></i>&emsp; Book List</a>
    <a href="update_stock.php"><i class="fad fa-caret-right"></i>&emsp; Stock Update</a>
    <a href="book_issue.php"><i class="fad fa-caret-right"></i>&emsp; Issue Book</a>
    <a href="issue_list.php"><i class="fad fa-caret-right"></i>&emsp; Issue List</a>
    <a href="book_return.php"><i class="fad fa-caret-right"></i>&emsp; Return Book</a>
    <a href="return_list.php"><i class="fad fa-caret-right"></i>&emsp; Return List</a>
  </div>
</div>

<script type="text/javascript">
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>
