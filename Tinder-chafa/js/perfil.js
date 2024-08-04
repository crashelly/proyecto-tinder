/*function updateProfile(ciudad, estado, gusto) {
    document.getElementById('perfil-city').innerHTML = `Ciudad: ${ciudad}`; 
    document.getElementById('perfil-estado').innerText = estado;
    document.getElementById('perfil-gusto').innerText =` Gustos: ${gusto}`;
}
*/
/*
function updateProfileFromForm() {
    const ciudad = document.getElementById('ciudad').value; 
    const estado = document.getElementById('estado').value;
    const gusto = document.getElementById('gusto').value;

    updateProfile(ciudad, estado, gusto); 
}
*/
function iraMatches(){
    window.location.href = 'matches.php';
}
/*document.getElementById('matchs-btn').addEventListener('click', function() {
    window.location.href = 'matches.php';*/ 

document.getElementById('chats-btn').addEventListener('click', function() {
    window.location.href = 'chatinterfaz.html';
});