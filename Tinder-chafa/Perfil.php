<?php 
include("../php/connection.php");
    session_start();
   $con = connection();
    
   //verificamos si se ha iniciado sesión o se ha guardado el username
  if (isset($_SESSION['username'])){
    $var_username = $_SESSION['username'];
    
  }else{}
// => query 1
   $consulta_datos_1= "SELECT * FROM users_info WHERE username='$var_username'";
   $query_usuario= mysqli_query($con, $consulta_datos_1);
// =>query 2 
    $consulta_datos_2= "SELECT * FROM users WHERE username='$var_username'";
    $query_datos_2 = mysqli_query($con, $consulta_datos_2);
// => query 1 y 2  son para obtener los datos del usuario en la tabla de users_info
// => query 2 es para obtener los datos del usuario en la tabla de users donde se insertaran los datos
    $datos_1 = mysqli_fetch_array($query_usuario);
    $datos_2 = mysqli_fetch_array($query_datos_2);

   //=>>>>>> print_r($datos_2) ;
  $id_user = $datos_1['id_user'];
  $_SESSION['id_user'] = $id_user;
  
// -> creacion de la clase de usuario que sera 

  class User {
    public $name;
    public $num_phone;
    public $gender;
    public $birth_date;
    public $username;
    public $email;

  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Tinder</title>
    <link rel="stylesheet" href="css/perfil.css">
</head>
<!-- -->
<body>
    <div class="perfil-contenedor">
        <img id="perfil-img" src="img/1-intro-photo-final.jpg" alt="Foto de perfil" class="perfil-img">
        <div class="perfil-info">
            <h1 id="perfil-name"><?php echo $datos_1['name']; ?></h1>
            <p id="perfil-city">Ciudad: <?php if($datos_2 != null){ echo $datos_2['city'];}?></p>
            <p>Estado: <span id="perfil-estado" class="estado"> <?php if($datos_2 != null){ echo $datos_2['estado'];}?></span></p>
            <p id="perfil-gusto">Gustos:  <?php if($datos_2 != null){ echo $datos_2['interest'];}?></p>
        </div>
        <form id="perfil-form" action="../php/UpdateUserInfo.php" method="POST">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="city"><br><br>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado"><br><br>

            <label for="sobreMI">Sobre mi:</label>
            <input type="text" id="sobreMi" name="descrition"><br><br>

            <label for="gusto">Gustos:</label>
            <input type="text" id="gusto" name="interest"><br><br>

            <button type="submit" id="actualizar-btn" onclick="updateProfileFromForm()">Actualizar Perfil</button>
        </form>
        <div class="perfil-buttons">
            <button id="chats-btn"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAwFJREFUSEvF1llIVFEYB/D/d2fRjIweMpW5hlRkRNHyIvSQFjFXK1pASUfDesgy6CkqkEAkX4SWh2iRHiZtRnIolJZxQvAhe6gQLAgtWsi5yYAEJS06y/1qxrFmX5wZvE8D93z/3/nOOfcwhAV6aIFcJAXX2xyLPXBuBUgEuMA7aWKaILA9x6Ue7thb+CvRRuLCR/sml0xnTTcRwQDGhhjBDOA1QEbnFN+0VIu/Y00iOsxMdTb5FAOtAHIT7cQ/7isB5+5I4q1odRHh2oefl5FauA+gLEkwaDgxP8hxqw9F2oIw2I8+BbA+FXSulkBDOS5BH4oHwVU9rNIulYfAKE0HGpDRZ5LE/YGZQXBtv9xK4PNpRn1xTGg068WO/yvh/9XSwsL7UtnBwPJMwABGTJK4OQw2WOWdIB6IgXYL5Gl2K+p8gfgagE3+sSMKU5NacDsUVrUBqImW4VZ49d3Kog++739uUJ1VbmTiG9GKFFKt69YXjnnfG/rl4wBfnx1LJ0ySzldXY5soEdgzGi2DmarNFTpLEGywjTeD6UK0IpWH1nbu1r0LhQP3Lh4M4KxJEtuT6piBewJzp0LCUgF8moGN/km+YtBFQJki0OG/t9fB6B3zEXNFkTG44ydftkFRhjJ0sHyxAqG0Sy8+D4Kret5otbm5dgB5GcLfmiSxJOxUz+7d+EmArmYEJmow6XW3I8LemysrV37JwL/vLU2TGDRJ4o7ArLC7umbg4wrBrfHe1WvSg/KoU9Fst1QWTMaEvS/rbY48hZ1WgLakiL9wKuo9oWjQ4QoFGgY/ZbtnNJcYfAyAKskJ/ATQ7pzStVmqyROpNu4/kNr+8X0E6o0HEzDDIBuz0q3N9vQay4unY9XEheus9jImDEYI8RDjsgKMkYrtAmufdenzvZ0m9MwXtjMpB8z6lcMJKREGzQd+5FQ5DZZdq77PF415uOZCA5baBdAZk6S7kgoY8QKJFOiHO1Nd2tDsuEtteCzrNItcP4zlxd/S0WnCHacTi3tzZQoLzP0Dj4kgLgdbr+QAAAAASUVORK5CYII="/></button>
            <a href="matches.php"><button  id="matchs-btn"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAi5JREFUSEvl1j9o1HAUB/DvS3OCSwsKreCiCLrUSeji4uVQLCoFoZdLqYugiBcXp4rLDYLFpaD3swjqotT7Q6GLQ2mTK4qIuChOLoqTOtjFQc6LeSXt3eFd/lxyTahgpiT8+H3ee7+XX36EHbpoh1z8u/BkZXJgHfuOwLJkQ5v/AAJ7ValQKEgvD38fhSxbe/DtYzVb/RNUTd+MlZI+DvAtAEcBpJqT1AG8IQkzRla8dt6ly/px2DxLhDEAu5rjGgS8B0k3DPXeqlcALvjYg8upwaHULAHXA9efaA7sBMR60DgG3+GR4Ztr6YL19zgXrJT0RYDPx9p0jIqpCdUXzpT1aWZ+EivanoyyZq5YbT22M3aa6Ic9/AXA/mRgfDJz4pALVhZ0BRIbCaGb0xJ4zMjdf7t137yUkn4N4LuJwkQXDLX4tAu+OgPQ7SRhAJfMnHjYAafL+YvEeJQkzGyfrWnzzzvgE8+uHJBo4HOCcKO++9feVxOPf3bAzkOmlF9iYCIJnAmipor2ZtOxgZyq6Actm98BGIwTJ6KvMqVGl7Nz667Pqd3dW5/VMgA5JtwCIWOq4kXglrlZ8oX8SZbgNEHr59BvDA2yccaYEivdE/j+nWLAfVFXc3VHtQ08EO0J91n2nmgoOCJeJxvnvNY09Br3UfbQaOiMW0EErHldYjq9qhXXwrZ/5FOmBx4ZjZyxR+Z21Ex9d66wpXJOocz8u6aJvg4PkUsdNrBe4/4/eAMJ084f4QuYYAAAAABJRU5ErkJggg=="/></button></a>
        </div>
    </div>
    <script src="js/perfil.js"></script>
</body>
</html>