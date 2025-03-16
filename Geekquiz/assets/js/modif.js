document.addEventListener('DOMContentLoaded', function() {
    // Maquer le formuliare d'ajoût de question
    const addFormular = document.getElementById('new_question_form');
    const questionButtonDiv = document.getElementById('question_move');
    const addButton = document.getElementById('add_question');
    const modifyButton = document.getElementById('modif_question');
    const modifyFormular = document.querySelectorAll('.modify_question_form');
    addFormular.style.display = 'none';
    modifyButton.style.display = 'none';
    // Ajouter un écouteur d'événement sur le bouton d'ajout de question
    addButton.addEventListener('click', function() {
        //Afficher le formulaire d'ajout de question
        addFormular.style.display = 'block';
        questionButtonDiv.style.display = 'none';
        // Masquer les formulaires de modification
        modifyFormular.forEach(form => {
            form.style.display = 'none';
        });
        modifyButton.style.display = 'block';
    });
    // Ajouter un écouteur d'événement sur le bouton de modification de question
    modifyButton.addEventListener('click', function() {
        //Afficher le formulaire de modification de question
        modifyFormular.forEach(form => {
            form.style.display = 'block';
        });
        modifyButton.style.display = 'none';
        // Masquer le formulaire d'ajout de question
        addFormular.style.display = 'none';
        questionButtonDiv.style.display = 'block';
    });
    // Gerer la zone de texte pour l'ajout de question
    const textarea = document.querySelector('textarea');
    textarea.addEventListener('keyup', e => {
        textarea.style.height = 'auto';
        let scrollHeight = e.target.scrollHeight;
        textarea.style.height = scrollHeight + 'px';
    });
    // Demander a l'utilisateur une confirmation pour supprimer
    const del = document.querySelector('.del');
    del.addEventListener('click', () => {
        confirm("Êtes-vous sûr de vouloir supprimer cette question et toutes ses réponses ?");
    });
});