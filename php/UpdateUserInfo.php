<?php 
include("connection.php");
$con = connection();
session_start();
$username =$_SESSION['username'];
print_r($username);


$city = $_POST['city'];
$estado  = $_POST['estado'];
$aboutMe = $_POST['descrition'];
$gustos  = $_POST['interest'];


print_r($city ." ". $estado. " ". $gustos);

$sql_update ="UPDATE users SET descrition='$aboutMe',city='$city', estado='$estado', interest='$gustos' WHERE username='$username'";
$query = mysqli_query($con, $sql_update);


header("Location:../Tinder-chafa/Perfil.php");
?>