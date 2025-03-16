// Filtrer les quizzes au clique sur la semi-nav
document.addEventListener('DOMContentLoaded', function() {
    let all = document.getElementById('all')
    all.classList.add('click')
    const filterButtons = document.querySelectorAll('.filter-button');
    const quizItems = document.querySelectorAll('.dispose');
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('click'));
            this.classList.add('click');
            const category = this.id;
            quizItems.forEach(item => {
                if (category === 'all' || item.classList.contains(category)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
//affichage de la page courante de l'utilisateur
let navLinks = document.querySelectorAll('.navLinks');
const activePage = window.location.pathname.split('/').pop(); // Récupère uniquement le nom du fichier
navLinks.forEach(link => {
    const linkPage = link.href.split('/').pop(); // Récupère uniquement le nom du fichier de chaque lien
    link.closest('.list').classList.remove('act');
    if (linkPage === activePage) {
        link.closest('.list').classList.add('act');
    }
});
// affichage de la page courante de l'utilisateur en version responsive
document.addEventListener('DOMContentLoaded', function() {
    let respoNavlinks = document.querySelectorAll('.nav-link');
    const respoActivePage = window.location.pathname.split('/').pop(); // Récupère uniquement le nom du fichier
    respoNavlinks.forEach(link => {
        const linkPage = link.getAttribute('href').split('/').pop(); // Récupère uniquement le nom du fichier de chaque lien
        link.classList.remove('active');
        if (linkPage === respoActivePage) {
            link.classList.add('active');
        }
    });
});
//MEssages d'excuse au clique sur le button multijoueur
let multi = document.querySelector('.startM')
multi.addEventListener('click',() => {
    alert("Désolé, le mode multijoueur du quiz n'est pas encore disponible, mais on y travaille pour que vous puissiez en profiter au plus vite ! 😊")
});