let currentQuestionIndex = 0;
let score = 0;
let correctAnswersCount = 0;
let incorrectAnswersCount = 0;

const questions = document.querySelectorAll('.question-container');
const nextButton = document.getElementById('nextButton');
const submitButton = document.getElementById('submitButton');
const correctCounter = document.getElementById('questCorrect');
const incorrectCounter = document.getElementById('questFailed');
// Fonction qui gere l'affichage des questions et des buttons
function showQuestion(index) {
    questions.forEach((q, i) => {
        q.style.display = i === index ? 'block' : 'none';
        q.classList.remove('slideffect');
        if (i === index) {
            setTimeout(() => q.classList.add('slideffect'), 30);
        }
    });
    if (index === questions.length - 1) {
        nextButton.style.display = 'none';
        submitButton.style.display = 'block';
    } else {
        nextButton.style.display = 'block';
        submitButton.style.display = 'none';
    }
}
//Actualise l'affichage du score a chaque question 
function updateScoreCounters() {
    correctCounter.textContent = `Questions correctes : ${correctAnswersCount}`;
    incorrectCounter.textContent = `Questions incorrectes : ${incorrectAnswersCount}`;
}
// Fonction utilser pour verifier si ce que l'utilisateur a cliquer est correcte et actualiser le score
function handleNextButtonClick() {
    let selectedSlide = document.querySelector(`#question-${currentQuestionIndex} .slide.clicked`);
    if (!selectedSlide) {
        alert("Veuillez sélectionner une réponse avant de continuer.");
        return;
    }
    let selectedInput = selectedSlide.querySelector('input');
    let isCorrect = selectedInput.getAttribute('data-correct') === 'true';
    if (isCorrect) {
        score++;
        correctAnswersCount++;
        console.log("Correct count",correctAnswersCount);
        selectedSlide.classList.add('correct');
    } else {
        incorrectAnswersCount++;
        selectedSlide.classList.add('incorrect');
    }
    updateScoreCounters();
    if (currentQuestionIndex < questions.length - 1) {
        currentQuestionIndex++;
        setTimeout(() => showQuestion(currentQuestionIndex), 500);
    }
}
    
// Au clique sur un label on enleve a tous les elements de la classe slide la classe clicked et on ajoute la classe clicked au label clicker
let labels = document.querySelectorAll('label');
labels.forEach(label => {
    label.addEventListener('click', () => {
        let slide = label.closest('.slide');
        let slider = slide.closest('.slider');
        slider.querySelectorAll('.slide').forEach(opt => opt.classList.remove('clicked'));
        slide.classList.add('clicked');
    });
});
    
nextButton.addEventListener('click', handleNextButtonClick);
    
// Initialisation de l'affichage
showQuestion(currentQuestionIndex);
// Affiche les règles du jeu
document.addEventListener('DOMContentLoaded', function() {
    const rulesButton = document.querySelector('.rules-button');
    const rulesPopup = document.querySelector('.rules-popup');
    const closePopup = document.querySelector('.close-popup');
  
    rulesButton.addEventListener('click', function() {
        rulesPopup.style.display = 'block';
    });
  
    closePopup.addEventListener('click', function() {
        rulesPopup.style.display = 'none';
    });
  
    // Fermer la popup si on clique en dehors
    window.addEventListener('click', function(event) {
        if (event.target == rulesPopup) {
            rulesPopup.style.display = 'none';
        }
    });
  });