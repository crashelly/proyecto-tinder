<?php 

// cuando utilice  variables van a haber d edos tipos
//nombre_query = la consulta que se quiere hacer ejem pass_query = "SELECT password FROM users WHERE username='$username'";
// nombre_sql = es el dato que devolvio la query (pass-sql)
//nombre_row = es el arreglo que devuelve la query(pass_row)
    include("connection.php");
    $con = connection();
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
    }

    $query = "SELECT password,name,email,num_phone,gender FROM users_info WHERE username='$username'";
    $pass_sql = mysqli_query($con, $query);
    $row = mysqli_fetch_array($pass_sql);

   
    if($row['password'] == $password){
        session_start();
       $_SESSION['username'] = $username;
        Header("Location: ../Tinder-chafa/Perfil.php");
        exit();
    } else{
        print_r("Contraseña incorrecta");
          echo "<script>alert('contraseña incorrecta');
               
                setTimeout(() =>{
                  window.location.href = '../index.php';
                }, 400);  
          
          
          </script>";
          exit();
        //Header("Location:../index.php");
    }  if($row == null){
        echo "<scrit>alert('el usuario no existe');

          
        setTimeout(() =>{
          window.location.href = '../index.php';
        }, 400);  
  
  
  </script>";
  exit();
    }
    
   

?>