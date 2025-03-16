let questionsList = [
    {
    text: "Quel est le plus grand pays du monde en superficie ?",
    answers: [
        {
          text: "A- Canada",
          isCorrect: false
        },
        {
          text: "B- États-Unis",
          isCorrect: false
        },
        {
          text: " C- Russie ",
          isCorrect: true
        },
        {
            text: " D- Chine",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quelle est la capitale du Brésil ?",
      answers: [
        {
          text: "A- Rio de Janeiro",
          isCorrect: false
        },
        {
          text: "B- São Paulo",
          isCorrect: false
        },
        {
          text: "C- Brasília",
          isCorrect: true
        },
        {
          text: "D- Salvador",
          isCorrect: false
        }
      ]
    },
    {
      text: "Combien y a-t-il de continents sur Terre ?",
      answers: [
        {
          text: "A- 5",
          isCorrect: false
        },
        {
          text: "B- 6 ",
          isCorrect: false
        },
        {
          text: "C- 7",
          isCorrect: true
        },
        {
            text: "D- 8",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quel océan borde la côte ouest des États-Unis ?",
      answers: [
        {
          text: "A- Océan Indien",
          isCorrect: false
        },
        {
          text: "B- Océan Atlantique",
          isCorrect: false
        },
        {
          text: "C- Océan Arctique",
          isCorrect: false
        },
        {
          text: "D- Océan Pacifique",
          isCorrect: true
        }
      ]
    },
    {
      text: "Quel est le plus long fleuve du monde ?",
      answers: [
        {
          text: "A- Amazonie",
          isCorrect: false
        },
        {
          text: "B- Nil",
          isCorrect: true
        },
        {
          text: "C- Mississippi",
          isCorrect: false
        },
        {
          text: "D- Yangtsé",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel pays a la plus grande population en 2024 ?",
      answers: [
          {
            text: "A- États-Unis",
            isCorrect: false
          },
          {
            text: "B- Inde",
            isCorrect: true
          },
          {
            text: "C- Chine",
            isCorrect: true
          },
          {
              text: "D- Indonésie",
              isCorrect: false
          }
        ]
      },
      {
        text: "Quelle est la capitale de l’Australie ?",
        answers: [
          {
            text: "A- Sydney",
            isCorrect: false
          },
          {
            text: "B- Melbourne",
            isCorrect: false
          },
          {
            text: "C- Canberra",
            isCorrect: true
          },
          {
            text: "D- Brisbane",
            isCorrect: false
          }
        ]
      },
      {
        text: "Dans quel pays se trouve la Tour Eiffel ?",
        answers: [
          {
            text: "A- Espagne",
            isCorrect: false
          },
          {
            text: "B- Italie",
            isCorrect: false
          },
          {
            text: "C- Allemagne",
            isCorrect: false
          },
          {
              text: "D- France ",
              isCorrect: true
          }
        ]
      },
      {
        text: "Dans quel pays se trouve le Taj Mahal ?",
        answers: [
          {
            text: "A- Pakistan",
            isCorrect: false
          },
          {
            text: "B- Inde ",
            isCorrect: true
          },
          {
            text: "C- Népal",
            isCorrect: false
          },
          {
            text: "D- Bangladesh",
            isCorrect: false
          }
        ]
      },
      {
        text: "Quel pays est surnommé 'le pays du Soleil-Levant' ?",
        answers: [
          {
            text: "A- Chine",
            isCorrect: false
          },
          {
            text: "B- Japon",
            isCorrect: true
          },
          {
            text: "C- Corée du Sud",
            isCorrect: false
          },
          {
            text: "D- Vietnam",
            isCorrect: false
        }
      ]
    }
  ];
  console.log(questionsList[4].answers[0].isCorrect)

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