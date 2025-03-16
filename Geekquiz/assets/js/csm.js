let questionsList = [
    {
      text: "Quel est le nom du protagoniste principal de la série Chainsaw Man ?",
      answers: [
        {
          text: "A- Denji",
          isCorrect: true
        },
        {
          text: "B- Makima",
          isCorrect: false
        },
        {
          text: "C- Aki Hayakawa",
          isCorrect: false
        },
        {
          text: "D- Power",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de l'organisation qui emploie Denji ?",
      answers: [
        {
          text: "A- Division de sécurité publique",
          isCorrect: true
        },
        {
          text: "B- Division de police",
          isCorrect: false
        },
        {
          text: "C- Division de l'armée",
          isCorrect: false
        },
        {
          text: "D- Division de la marine",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du démon qui est fusionné avec Denji ?",
      answers: [
        {
          text: "A- Pochita",
          isCorrect: true
        },
        {
          text: "B- Makima",
          isCorrect: false
        },
        {
          text: "C- Power",
          isCorrect: false
        },
        {
          text: "D- Blood Fiend",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de l'ennemi principal de la série Chainsaw Man ?",
      answers: [
        {
          text: "A- Makima",
          isCorrect: true
        },
        {
          text: "B- Denji",
          isCorrect: false
        },
        {
          text: "C- Aki Hayakawa",
          isCorrect: false
        },
        {
          text: "D- Power",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de la capacité spéciale de Denji ?",
      answers: [
        {
          text: "A- Chainsaw Devil",
          isCorrect: true
        },
        {
          text: "B- Blood Fiend",
          isCorrect: false
        },
        {
          text: "C- Devil Hunter",
          isCorrect: false
        },
        {
          text: "D- Contract Devil",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du partenaire de Denji ?",
      answers: [
        {
          text: "A- Power",
          isCorrect: true
        },
        {
          text: "B- Makima",
          isCorrect: false
        },
        {
          text: "C- Aki Hayakawa",
          isCorrect: false
        },
        {
          text: "D- Himeno",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de l'organisation qui est l'ennemi de la Division de sécurité publique ?",
      answers: [
        {
          text: "A- Division de la marine",
          isCorrect: false
        },
        {
          text: "B- Division de l'armée",
          isCorrect: false
        },
        {
          text: "C- Division de police",
          isCorrect: false
        },
        {
          text: "D- Katana Man",
          isCorrect: true
        }
      ]
    },
    {
      text: "Quel est le nom du démon qui est le plus puissant de la série Chainsaw Man ?",
      answers: [
        {
          text: "A- Makima",
          isCorrect: true
        },
        {
          text: "B- Denji",
          isCorrect: false
        },
        {
          text: "C- Power",
          isCorrect: false
        },
        {
          text: "D- Blood Fiend",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de la technique spéciale de Makima ?",
      answers: [
        {
          text: "A- Reality Manipulation",
          isCorrect: true
        },
        {
          text: "B- Devil Hunter",
          isCorrect: false
        },
        {
          text: "C- Contract Devil",
          isCorrect: false
        },
        {
          text: "D- Blood Fiend",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du dernier arc de la série Chainsaw Man ?",
      answers: [
        {
          text: "A- Arc de Makima",
          isCorrect: true
        },
        {
          text: "B- Arc de Denji",
          isCorrect: false
        },
        {
          text: "C- Arc de Power",
          isCorrect: false
        },
        {
          text: "D- Arc de la Division de sécurité publique",
          isCorrect: false
        }
      ]
    }
  ];
let score = 0
let questFailedScore = 0;
let questContainer = document.querySelector(".quizz-text");
console.log(questContainer);
function shuffle(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
}

shuffle(questionsList); // Mélanger les questions

let currentQuestionIndex = 0;
let answerContainer = document.getElementById("answer-container");
let nextButton = document.getElementById("next-button");
let restartButtons = document.querySelector(".resetings");

function displayQuestion() {
    if (currentQuestionIndex < questionsList.length) {
        let question = questionsList[currentQuestionIndex];
        questContainer.textContent = question.text;
        answerContainer.innerHTML = '';
        question.answers.forEach((answer, index) => {
            answerContainer.innerHTML += `
                <div class="slide">
                    <input type="radio" name="answer" id="answer${index}" value="${index}">
                    <label for="answer${index}">${answer.text}</label>
                </div>
            `;
        });
    } else {
        questContainer.textContent = "Quiz terminé!";
        answerContainer.innerHTML = `Votre score final est: ${score}/${questionsList.length}`;
        nextButton.style.display = 'none';
        let questCorrect = document.getElementById("questCorrect");
        questCorrect.textContent = `Questions correctes: ${score}/${questionsList.length}`;
        let questFailed = document.getElementById("questFailed");
        questFailedScore = questionsList.length - score;
        questFailed.textContent = `Questions incorrectes: ${questFailedScore}/${questionsList.length}`;
        restartButtons.classList.remove('none');
        let regle = document.querySelector('.rules');
        regle.classList.add('none');
        let comment = document.querySelector(".commente");
        if (score <= 3) {
          comment.innerHTML = '<strong>Tu as essayé, mais le résultat est médiocre. Continue à t\'améliorer !</strong>';
      } else if (score > 3 && score <= 6) {
          comment.innerHTML = '<strong>Tu as assez de connaissances dans cette catégorie. Continue à progresser !</strong>';
      } else if (score > 6 && score <= 10) {
          comment.innerHTML = '<strong>Tu es fort dans cette catégorie, ça ne fait aucun doute. Bravo !</strong>';  
      }
    }
    let response = document.querySelectorAll('.slide')
    response.forEach(rep => {
      rep.addEventListener('click', () => {
        response.forEach(ans => ans.classList.remove('clicked'));
        rep.classList.toggle('clicked');
      });
  });
}

nextButton.addEventListener('click', () => {
  let selectedAnswer = document.querySelector('input[name="answer"]:checked');
  if (selectedAnswer) {
      let answerIndex = parseInt(selectedAnswer.value);
      let answerElement = selectedAnswer.closest('.slide');
      if (questionsList[currentQuestionIndex].answers[answerIndex].isCorrect) {
          answerElement.classList.add('correct');
          score++;
      } else {
          answerElement.classList.add('incorrect');
      }
      document.querySelectorAll('input[name="answer"]').forEach(input => input.disabled = true);
      // Désactiver le bouton pendant l'affichage de la réponse
      nextButton.disabled = true;
      // Attendre 0.7 secondes avant de passer à la question suivante
      setTimeout(() => {
          currentQuestionIndex++;
          displayQuestion();
          nextButton.disabled = false;
      }, 700);
  } else {
      alert("Veuillez sélectionner une réponse avant de continuer.");
  }
});
// Initialiser l'affichage de la première question
displayQuestion();

// Reset le quiz

let reset = document.getElementById('reset');
reset.addEventListener('click', () => {
    window.location.reload();
});
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