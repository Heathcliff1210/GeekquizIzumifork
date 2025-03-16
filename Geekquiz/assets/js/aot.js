let questionsList = [
    {
    text: "Qui est cette personne qui a sauver ymir des affres de l'amoure ?",
    answers: [
        {
          text: "A- Connie ",
          isCorrect: false
        },
        {
          text: "B- Mikasa",
          isCorrect: true
        },
        {
          text: " C- Historia",
          isCorrect: false
        },
        {
            text: " D- Sasha",
            isCorrect: false
        }
      ]
    },
    {
      text: "Armin est le quantieme major du bataillon d'exploration ?",
      answers: [
        {
          text: "A- 6eme",
          isCorrect: false
        },
        {
          text: "B- 11eme",
          isCorrect: false
        },
        {
          text: "C- 15eme",
          isCorrect: true
        },
        {
          text: "D- 22eme",
          isCorrect: false
        }
      ]
    },
    {
      text: "Selon hansi quel est la qualité indispensable pour etre major du bataillon d'exploration ?",
      answers: [
        {
          text: "A- Etre courageux",
          isCorrect: false
        },
        {
          text: "B- Ne jamais baisser les bras",
          isCorrect: false
        },
        {
          text: "C- Ne jamais renoncer à comprendre",
          isCorrect: true
        },
        {
            text: "D- Etre un bon leader",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du titan qui a tué la mère d'eren ?",
      answers: [
        {
          text: "A- Le titan colossal",
          isCorrect: false
        },
        {
          text: "B- Le titan cuirassé",
          isCorrect: false
        },
        {
          text: "C- Le titan souriant",
          isCorrect: true
        },
        {
          text: "D- Le titan bestial",
          isCorrect: false
        }
      ]
    },
    {
      text: "Comment s'appelle la soeur de Grisha Yeager ?",
      answers: [
        {
          text: "A- Carla Yeager", 
          isCorrect: false
        },
        {
          text: "B- Dina Fritz",
          isCorrect: false
        },
        {
          text: "C- Frieda Reiss",
          isCorrect: false
        },
        {
          text: "D- Faye Yeager",
          isCorrect: true
        }
      ]
    },
    {
      text: "Selon Annie les 4 longues annés passé enfermer dans la glace à ecouté Armin et Hitch etait comme quoi ?",
      answers: [
          {
            text: "A- Un cauchemar",
            isCorrect: false
          },
          {
            text: "B- Un rêve au contour flous",
            isCorrect: true
          },
          {
            text: "C- Une longue agonie",
            isCorrect: false
          },
          {
              text: "D- Un long silence",
              isCorrect: false
          }
        ]
      },
      {
        text: "Comment s'appelle le chef des trois corps d'armée?",
        answers: [
          {
            text: "A- Erwin Smith",
            isCorrect: false
          },
          {
            text: "B- Dot Pixis",
            isCorrect: false
          },
          {
            text: "C- Daris Zackley",
            isCorrect: true
          },
          {
            text: "D- Nile Dok",
            isCorrect: false
          }
        ]
      },
      {
        text: "Qui avait remarquer l'absence d'eren lors de la reunion chez le clasn azumabito ?",
        answers: [
          {
            text: "A- Armin",
            isCorrect: false
          },
          {
            text: "B- Mikasa",
            isCorrect: true
          },
          {
            text: "C- Jean",
            isCorrect: false
          },
          {
              text: "D- Sasha",
              isCorrect: false
          }
        ]
      },
      {
        text: "Pour quel raison Annie voulais t'elle s'engager dans la brigade special?",
        answers: [
          {
            text: "A- Pour se venger de son père",
            isCorrect: false
          },
          {
            text: "B- Pour rester en vie le plus longtemps possible",
            isCorrect: true
          },
          {
            text: "C- Pour le salaire de la brigade",
            isCorrect: false
          },
          {
            text: "D- Pour tué le plus de titan ",
            isCorrect: false
          }
        ]
      },
      {
        text: "Qui s'etait fais volé sa bourse par un enfants migrant lors de l'arriver du bataillon d'exploration sur mahr ?",
        answers: [
          {
            text: "A- Sasha",
            isCorrect: true
          },
          {
            text: "B- Livai",
            isCorrect: true
          },
          {
            text: "C- Marco",
            isCorrect: false
          },
          {
            text: "D- Historia",
            isCorrect: false
        }
      ]
    }
  ];

let score = 0
let questFailedScore = 0;
let questContainer = document.querySelector(".quizz-text");
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