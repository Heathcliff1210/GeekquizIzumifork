let questionCount = 1; // Commencer à 1 puisque le premier formulaire existe déjà

function addQuestion() {
    const questionsContainer = document.getElementById('questions-container');
    // Créer un nouvel élément div pour la nouvelle question
    const newQuestionDiv = document.createElement('div');
    newQuestionDiv.classList.add('questions');
    newQuestionDiv.innerHTML = `
        <div class="mb-3 question">
            <textarea class="form-control" placeholder="Question ${questionCount}" name="question_${questionCount}" id="question_${questionCount}" required></textarea>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="answer_${questionCount}_1" placeholder="Réponse 1" name="answer_${questionCount}_1" required>
            <input type="text" class="form-control" id="answer_${questionCount}_2" placeholder="Réponse 2" name="answer_${questionCount}_2" required>
            <input type="text" class="form-control" id="answer_${questionCount}_3" placeholder="Réponse 3" name="answer_${questionCount}_3" required>
            <input type="text" class="form-control" id="answer_${questionCount}_4" placeholder="Réponse 4" name="answer_${questionCount}_4" required>
        </div>
        <select class="form-select" id="correct_answer_${questionCount}" name="correct_answer_${questionCount}" required>
            <option value="">Réponse correcte</option>
            <option value="1">Réponse 1</option>
            <option value="2">Réponse 2</option>
            <option value="3">Réponse 3</option>
            <option value="4">Réponse 4</option>
        </select>
    `;
    
    // On ajoute le nouvel élément à la fin du conteneur
    questionsContainer.appendChild(newQuestionDiv);
    // Incrémenter le compteur
    questionCount++;
}

// Ajouter un écouteur d'événement pour le bouton d'ajout de question existant
let add = document.querySelector('.add_question');
if (add) {
    add.addEventListener('click', addQuestion);
}

document.addEventListener('DOMContentLoaded', function() {
    const questionsContainer = document.getElementById('questions-container');
    // On verifie s'il y a déjà des questions
    const existingQuestions = questionsContainer.querySelectorAll('.questions');
    // Si aucune question n'existe en créer une
    if (existingQuestions.length === 0) {
        addQuestion();
    }
});