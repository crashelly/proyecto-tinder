<?php 
    include("connection.php");
    $con = connection();
    $sql = "SELECT * FROM users";
    $query = mysqli_query($con, $sql);
?>