<?php
require 'connect.php';
$x = $_POST['id'];
$sql = "SELECT * FROM `book` WHERE bookname='$x'";
$result = mysqli_query($con, $sql);
while ($res = mysqli_fetch_assoc($result)) {
	$code = $res['bookcode'];
	$aut = $res['author'];
	$publ = $res['publisher'];
	$stck = $res['stock'];
}
$d = $code.'@'.$aut.'@'.$publ.'@'.$stck;
echo $d;
?>