<?php 
/*objetivo cvrear un bucle que me cree un array y que cargue los objetos de las personas para que luego el javascripot me los muestre en pa*/
include("../php/connection.php");
session_start();
if (isset($_SESSION['username'])){
    $var_username = $_SESSION['username'];
    $id_actual_user = $_SESSION['id_user'];
  }else{}

$con = connection();
$get_max_users_id = "SELECT MAX(id_user) as Max_users_id FROM users_info ";
$max_users_id = mysqli_query($con,$get_max_users_id);
$MaxUserIdArray = mysqli_fetch_array($max_users_id);
$max_Id = $MaxUserIdArray["Max_users_id"] ;
// crear el bucle para guardar todos los perfiles


function AgeCalculator($birth_date){
    // fecha actual
        $actual_date = new DateTime();
        $actual_date= $actual_date->format('Y-m-d');
    // convierte la fecha en segundos para poder calcular la edad
    $birth_date  = strtotime($birth_date);
    $actual_date = strtotime($actual_date);

    // 31536000 = segundos en un año
    $ageDiference= $actual_date - $birth_date;
    $ageDiference_years=  $ageDiference  /31536000 ;

    return $ageDiference_years;

}

//====================================================
class Perfil{
    public $img;
    public $name;
    public $city;
    public $age;
    public $estado;
    public $aboutMe;
    public $interest;

}
//array para guardar todos los perfiles

$perfiles_array = array();
// => perfil se vuelve a una clase
$perfiles = new stdClass();

/*function GetQuery( $con,$max_Id, $id_actual_user,$i_loop){
    if($i_loop <= $max_Id){
        if ($i_loop != $id_actual_user){ 
            $query1_perfil = "SELECT * FROM users_info WHERE id_user =$i_loop";
            $query1 = mysqli_query($con, $query1_perfil);
            $datos_1 = mysqli_fetch_array($query1);
            $user_username = $datos_1['username'];

            $query2_perfil = "SELECT * FROM users WHERE username ='$user_username'";
            $query2 = mysqli_query($con, $query2_perfil);
            $datos_2 = mysqli_fetch_array($query2);
        //
    
        // => creacion de objeto para cada perfil
        // => formateo de variables 
        $user_username = '';
        }
    }
}
*/


//====================================================
// funcion que crea los objetos para cada perfil por cada iteracion del bucle
function createPerfil($i_loop,$datos_1,$datos_2,$perfiles){
    $perfil = new stdClass();
 //   ${"perfil$i_loop"}-> img =  $datos_2['img_url'];
   // $perfiles[$i_loop]-> idUser = $datos_1["id_user"];
    $perfil-> name =  $datos_1['name'];
    $perfil-> age =  AgeCalculator($datos_1['birth_date']) ;
    $perfil-> city = $datos_2['city'];
    $perfil-> estado = $datos_2['estado'];
    $perfil->aboutMe = $datos_2['descrition'];
    $perfil-> interest = $datos_2['interest'];
    return $perfil;
//añado el objeto al array    
}

//=======================================================
// pruebas

function getNextElement($array) {
    static $index = 0; // Índice interno que se mantiene entre llamadas
    //static $callCount = 0; // Contador de llamadas
  
  //  $callCount++; // Incrementa el contador de llamadas
  /*
    if ($callCount % 6 == 0) { // Cada 6 llamadas, incrementa el índice
      $index = ($index + 1) % count($array); // Asegura que no se salga del array
    }
  */
    if ($index < count($array)) {
      $element = $array[$index];
      print_r($element); // Imprime el elemento actual
      return $element;
    } else {
      return null; // Devuelve null si se ha llegado al final del array
    }
  }
 //print_r(getNextValue($perfilitos_array)); 

function getDataUsers($con,$i,$id_actual_user,$parameterOfQuery){
    
    if( $i  != $id_actual_user ){
        
        $query1_perfil = "SELECT * FROM users_info WHERE id_user =$i";
        $query1 = mysqli_query($con, $query1_perfil);
        $datos_1 = mysqli_fetch_array($query1);
        $user_username = $datos_1['username'];
      
       
        $query2_perfil = "SELECT * FROM users WHERE username ='$user_username'";
        $query2 = mysqli_query($con, $query2_perfil);
        $datos_2 = mysqli_fetch_array($query2);
       
       

// objeto listado 
        $perfil = new stdClass();
        $perfil-> name =  $datos_1['name'];
        $perfil-> age =  AgeCalculator($datos_1['birth_date']) ;
        $perfil-> city = $datos_2['city'];
        $perfil-> estado = $datos_2['estado'];
        $perfil->aboutMe = $datos_2['descrition'];
        $perfil-> interest = $datos_2['interest'];
       // return $perfil;
        if($parameterOfQuery == "name"){
             return $perfil->name;
        }else if ($parameterOfQuery == "age") {
             return $perfil->age;
        }else if($parameterOfQuery == "city"){
             return $perfil->city;
        }else if($parameterOfQuery == "city"){
             return $perfil->city;
        }else if ($parameterOfQuery == "estado"){
             return $perfil->estado;
        }else if($parameterOfQuery == "aboutMe"){
            return $perfil->aboutMe;
        }else if($parameterOfQuery == "interest "){
            return $perfil->interest;
        }
        
        $datos_2 ='';
        $datos_1 ='';
        $user_username ='';
    }

      
}
















// =============================================================
$array_ids =[];
$array_prueba =[0,1,2,3,4,5,6,7];

for($i = 0 ; $i <= $max_Id -1; $i++){
    $e = $i;
    if ($i != $id_actual_user -1){ 
    // => compribar el aumento
    // => array ids
        $array_ids[] = $i;

        $query1_perfil = "SELECT * FROM users_info WHERE id_user =$i+1";
        $query1 = mysqli_query($con, $query1_perfil);
        $datos_1 = mysqli_fetch_array($query1);
        $user_username = $datos_1['username'];

        $query2_perfil = "SELECT * FROM users WHERE username ='$user_username'";
        $query2 = mysqli_query($con, $query2_perfil);
        $datos_2 = mysqli_fetch_array($query2);
   
        $objeto_perfiles = createPerfil($i,$datos_1,$datos_2,$perfiles);
        $perfiles_array[$e] =$objeto_perfiles;
// formateo de variables 
        $user_username = '';
        $objeto_perfiles = '';
        $query1_perfil='';
        $query2_perfil ='';
    }
}

// cantidad de objetos en el array variable
$a = count($array_ids);

// => creacion de json del aray
$perfiles_arraysito = mysqli_fetch_array($perfiles_array);
   
 print_r($perfiles_array);

 //var_export($perfiles_array["0"]->city);
//print_r($array_ids);

$perfiles_JSON = json_encode($perfiles_array);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tinder Perfil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="profile-container" class="perfil">
        <div class="perfil-encabezado">
            <img src="img/1-intro-photo-final.jpg" alt="foto perfil">
            <h1 id="nombre"><?php print_r($perfiles_array["<script>console.log(e);</script>"]->name);?></h1>
            <p></p>
        </div>
        <div class="perfil-descripcion">
            <h2>Algo sobre mis tentacion</h2>
            <p></p>
        </div>
        <div class="perfil-inter">
            <h2>Gustos</h2>
            <ul>
                <li>...</li>
                <li>...</li>
                <li>...</li>
            </ul>
        </div>
        <div class="perfil-accion">
            <button class="dislike-boton"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAXtJREFUSEvtlb9KA0EQh7+dTWVnb+MLCL6BhIhBCVpYiHLGNFpq4QP4KCEaCxEJYmcjCjaK8VXUYBLun1zcQAhy2dyFnEW2ueLm5pvf72ZmFRkdlRGXGXhqzs+s/j9W12HeQzcC5LiC+x5X2Tm51YDwpIO/dQRuXGzsPz4DWUSaoJaAD0HyDu7bXwlr6FIIN0AOuCvjlxKDow+r6H0VPejN/GeAFCq4L4NJq+gNBQ0D7Qqq5ODdpwL/AW8FSL4PH4YGqGIF72FUs1iPUw29E8KlUd6DC8ECcGWUtgPUug00KsoaHAXX0Lsh1I2aFjAHCNAJUWsHeI+jlPbfjwU28Ej5BaBNkragCg7esy10bMWZgavoPfWrNjqDVn8LqujgPdmqtrbaorm6th1tbfXQLE9nnJIsEBvlNivzFdQy8CXIiuXKvC3jb6baXOaSuAY5LeM245KZLXbYwd9OdUnYdmiSOOuuTpI8ldWTBiZemZMqZGb1pJwcmSczq38AzyaKH0fthSAAAAAASUVORK5CYII="/></button>
            <button class="like-boton"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAi5JREFUSEvl1j9o1HAUB/DvS3OCSwsKreCiCLrUSeji4uVQLCoFoZdLqYugiBcXp4rLDYLFpaD3swjqotT7Q6GLQ2mTK4qIuChOLoqTOtjFQc6LeSXt3eFd/lxyTahgpiT8+H3ee7+XX36EHbpoh1z8u/BkZXJgHfuOwLJkQ5v/AAJ7ValQKEgvD38fhSxbe/DtYzVb/RNUTd+MlZI+DvAtAEcBpJqT1AG8IQkzRla8dt6ly/px2DxLhDEAu5rjGgS8B0k3DPXeqlcALvjYg8upwaHULAHXA9efaA7sBMR60DgG3+GR4Ztr6YL19zgXrJT0RYDPx9p0jIqpCdUXzpT1aWZ+EivanoyyZq5YbT22M3aa6Ic9/AXA/mRgfDJz4pALVhZ0BRIbCaGb0xJ4zMjdf7t137yUkn4N4LuJwkQXDLX4tAu+OgPQ7SRhAJfMnHjYAafL+YvEeJQkzGyfrWnzzzvgE8+uHJBo4HOCcKO++9feVxOPf3bAzkOmlF9iYCIJnAmipor2ZtOxgZyq6Actm98BGIwTJ6KvMqVGl7Nz667Pqd3dW5/VMgA5JtwCIWOq4kXglrlZ8oX8SZbgNEHr59BvDA2yccaYEivdE/j+nWLAfVFXc3VHtQ08EO0J91n2nmgoOCJeJxvnvNY09Br3UfbQaOiMW0EErHldYjq9qhXXwrZ/5FOmBx4ZjZyxR+Z21Ex9d66wpXJOocz8u6aJvg4PkUsdNrBe4/4/eAMJ084f4QuYYAAAAABJRU5ErkJggg=="/></button>
        </div>
    </div>
    <script src="">
        var perfiles_array = <?php print_r($perfiles_array)?>
    </script>
</body>
</html>


    