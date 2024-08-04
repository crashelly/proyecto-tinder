<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tinder</title>
    <link rel="stylesheet" href="Tinder-chafa/css/styles.css">
</head>
<body>
    <div class="login-cont">
        <div class="perfil-encabezado">
            <img src="Tinder-chafa/img/tinder-app-logo-tinder-app-icon-free-free-vector.jpg" alt="foto perfil">
        </div>
        <div class="login-forma">
            <h2>Login</h2>
            <form id="loginForm" action="php/validar_usuario.php" method="POST">
                <div class="input-grupo">
                    <label for="username" name="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-grupo">
                    <label for="password" name="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Entrar</button>
                <a href="form_registro/formulario.php">no tienes cuenta</a>
            </form>
        <div/>
    </div>
<H1>HOLA yei</H1>
    <script>
        /*
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            if (username === 'usuario' && password === 'contraseña') {
                alert('Inicio de sesión exitoso!') ;
                
            } else {
                alert('Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.');
                
            }
        });
        */
        asdasdada
        print('Hola mundo!');
    </script>
</body>
</html>