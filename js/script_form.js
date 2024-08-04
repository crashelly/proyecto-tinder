function registerUser() {
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;
    const phone = document.getElementById('phone').value;
    const gender = document.getElementById('gender').value;

    if (!name || !age || !phone || !gender) {
        alert('Por favor, complete todos los campos.');
        return;
    }

    const user = {
        name: name,
        age: age,
        phone: phone,
        gender: gender
    };

    console.log('Usuario registrado:', user);
    alert('Registro exitoso. Bienvenido, ' + name + '!');
}

function loginWithFacebook() {
    alert('Redirigiendo a la página de inicio de sesión de Facebook...');
    // Aquí podrías redirigir al usuario a la página de inicio de sesión de Facebook
    // Por ejemplo: window.location.href = 'https://www.facebook.com/login';
}