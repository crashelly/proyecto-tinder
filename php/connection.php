<?php 
  function connection(){
        $host  = "localhost";
        $user  = "root";
        $pass  = "";
        $BD    = "prueba_tinder";
        $connect = mysqli_connect($host,$user,$pass);
        mysqli_select_db($connect,$BD);
        return $connect; 
    }

?>