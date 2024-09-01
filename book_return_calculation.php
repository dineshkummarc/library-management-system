<?php
require 'connect.php';

$adm_no=$_POST['admnum'];
$bkcode=$_POST['bcode'];
$idate=$_POST['dt'];
$fn=$_POST['fine'];
$sql = "INSERT INTO `return`(`admission_no`,`bookcode`,`issue_date`,`fine`) VALUES ('$adm_no','$bkcode','$idate','$fn')";
$run = mysqli_query($con, $sql);

$sql1 = "SELECT stock FROM `book` WHERE bookcode='$bkcode'";
$run1 = mysqli_query($con, $sql1);
while($row3 = mysqli_fetch_assoc($run1))
{
	$stnumber=$row3['stock'];
}
$stnumber=$stnumber+1;
	
$sql2 = "UPDATE `book` SET stock='$stnumber' WHERE bookcode='$bkcode'";
$run2 = mysqli_query($con, $sql2);
	
$sql3 = "UPDATE `issue` SET status='0' WHERE bookcode='$bkcode'";
$run3 = mysqli_query($con, $sql3);
	
header("Location: book_return.php");
?>