
var e = 3;
document.addEventListener('DOMContentLoaded', function() {
    const profiles = [
        {
            img: 'img/1-intro-photo-final.jpg',
            nombre: 'John Doe',
            edad: '29, Los Angeles',
            descripcion: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero justo, a ultricies dui ultricies sed.',
            gustos: ['...', '...', '...']
        },
        {
            img: 'img/attractive-1869761_640.jpg',
            nombre: 'Jane Smith',
            edad: '27, New York',
            descripcion: 'Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta.',
            gustos: ['...', '...', '...']
        },
        {
          img: 'img/450_1000.jpeg',
          nombre: 'Will Smith',
          edad: '55, New York',
          descripcion: 'Vivamus luctus urna sed urna ultricies ac tempor dui sagittis. In condimentum facilisis porta.',
          gustos: ['...', '...', '...']
      },
    ];

    let currentIndex = 0;
    const profileContainer = document.getElementById('profile-container');

    function loadProfile(index) {
        const profile = profiles[index];
        profileContainer.querySelector('img').src = profile.img;
        profileContainer.querySelector('h1').textContent = profile.nombre;
        profileContainer.querySelector('p').textContent = profile.edad;
        profileContainer.querySelector('.perfil-descripcion p').textContent = profile.descripcion;
        const gustosList = profileContainer.querySelector('.perfil-inter ul');
        gustosList.innerHTML = '';
        profile.gustos.forEach(gusto => {
            const li = document.createElement('li');
            li.textContent = gusto;
            gustosList.appendChild(li);
        });
    }

    function handleSwipe(direction) {
        profileContainer.classList.add(direction);
        setTimeout(() => {
            currentIndex = (currentIndex + 1) % profiles.length;
            loadProfile(currentIndex);
            profileContainer.classList.remove(direction);
        }, 300);
    }

    document.querySelector('.like-boton').addEventListener('click', () => {
        handleSwipe('swipe-right');
        setTimeout(() => {
            window.location.href = 'its_a_match.html'; 
        }, 300); 
    });

    document.querySelector('.dislike-boton').addEventListener('click', () => {
        handleSwipe('swipe-left');
    });

    
    loadProfile(currentIndex);
});
