<?php

$host="localhost:3306";
$user="ictlabkz_qr";
$pass="!SherLock2023";
$dbnm="ictlabkz_qr";

$connection=mysqli_connect($host,$user,$pass,$dbnm);

session_start(); $name = $_SESSION['nameus'];

if(isset($_POST["erase"]))
{
 
	$query = mysqli_query($connection,"UPDATE `equipment` SET `inventnumcheck`='',`checked`='';");
	if ($query) 
	{
		header("location:../goods.php"); 
	}
 
}

?>