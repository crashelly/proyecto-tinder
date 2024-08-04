<?php 
    include("../php/connection.php");
    $con = connection();
    $sql = "SELECT * FROM users_info";
    $query = mysqli_query($con, $sql);

// conseguir todos los username de la base de datos
//consulta de  todos los usernames
$usernames = array();
// --> consultamos todos los usernames y los guardamos en un array
    $sql_all_usernames = "SELECT username FROM users_info";
    $query_all_users = mysqli_query($con, $sql_all_usernames);
  
    $allUsernames = mysqli_fetch_array($query_all_users);
//-> creacion de un blucle quue recorrendo el array de usernames
  
  while ($row = $query_all_users->fetch_assoc()){
    $usernames[] = $row['username'];
  }
  $json_usernames = json_encode($usernames);
?>


<!-- parte de php -->

<!---- html  -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/styless.css">
</head>
<body>
    <form action="../php/insert_user.php" method="POST" class="register-container" id="registration-form">
        <img src="img/file.png" alt="Logo" class="logo">
        <h2>Registrarse</h2>
        <input type="text" id="name"name="name" placeholder="Nombre" required>
        <input type="date" id="birthday" name="birth_date" placeholder="Fecha de nacimiento" required>
        <input type="tel" id="phone" name="num_phone"placeholder="Número de Celular" required>
        <input type="text" id="email"name="email" placeholder="Correo Electrónico" required>
        <input type="text" id="usuario" name="username" placeholder="crear usuario" required>
        <input type="password" id="password" name="password" placeholder="crear contraseña" required>
        <select id="gender"name="gender" required>
            <option value="" disabled selected>Género</option>
            <option value="male">Masculino</option>
            <option value="female">Femenino</option>
            <option value="other">Otro</option>
        </select>
        <button type="submit" >Registrarse</button>
        <button onclick="loginWithFacebook()" class="facebook-button"><a href="https://www.facebook.com/?locale2=es_ES&_rdr">Iniciar sesión con Facebook</a></button>
    </form>

    <script>
    // usernameFormInput es el campo de texto de username que el usuario digita en el formulario
      function validateEmail(email){
        var domain = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com', 'yahoo.com.mx', 'outlook.es', 'hotmail.es','.sena','.edu','.co','.com','.gov'];
        email = email.toLowerCase();
        for (var i = 0; i < domain.length; i++) {
            if (email.includes(domain[i])) {
                return true;
            }
            return false;
        }
    }
        document.addEventListener('submit', a =>{
            a.preventDefault();
            var usernameFormInput = document.getElementById('usuario').value;
            var email =  document.getElementById('email').value;
            console.log(usernameFormInput);
            validateUsers(usernameFormInput,email);
            
          
       });
        function validateUsers(username_form,email){
            var usernames = <?php echo $json_usernames;?>;

            if (!usernames.includes(username_form) && validateEmail(email) == true) {
                console.log('no lo contiene');
                
                alert("registro exitoso!❤");
                setTimeout(() =>{
                  document.getElementById('registration-form').submit();
                }, 1000);  
            
            }else{
                if (validateEmail(email) == false) {
                    alert('Por favor ingrese un correo válido');
                }else{
                          alert('El nombre de usuario ya existe');
                console.log('si lo contiene');
                document.getElementById('registration-form').preventDefault();
                }
          
            }
        }
       
 
        
        
        function registerUser() {
            validateUsers();
            
          
            // Aquí puedes agregar más lógica para el registro del usuario
        }

        function loginWithFacebook() {
            // Lógica para iniciar sesión con Facebook
        } 
       
        
        // validateUsers();
    </script>
</body>
</html>