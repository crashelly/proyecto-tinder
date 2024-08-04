<?php 
include("connection.php");
$con = connection();
$id_user = null;
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$birth_date = $_POST['birth_date'];
$num_phone = $_POST['num_phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];

$sql = "INSERT INTO users_info VALUES('$id_user','$username','$name','$password','$birth_date','$num_phone','$email','$gender')";
$query = mysqli_query($con,$sql);

$sql_query_users = "INSERT INTO users(username)VALUES('$username')";
$query = mysqli_query($con,$sql_query_users);


if($query){
    Header("Location: ../index.php");
    echo ('se envio');
   // Header("Location: ../form_registro/formulario.php");
}else{
    Header("Location: ../index.php");
    echo "error al enviar";
}
?>
