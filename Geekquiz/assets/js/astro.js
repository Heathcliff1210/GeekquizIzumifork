let questionsList = [
    {
    text: "Quelle est la planète la plus proche du Soleil ?",
    answers: [
        {
          text: "A- Vénus",
          isCorrect: false
        },
        {
          text: "B- Terre",
          isCorrect: false
        },
        {
          text: " C- Mercure ",
          isCorrect: true
        },
        {
            text: " D- Mars",
            isCorrect: false
        }
      ]
    },
    {
      text: "Combien de planètes composent le Système solaire ?",
      answers: [
        {
          text: "A- 7",
          isCorrect: false
        },
        {
          text: "B- 8",
          isCorrect: true
        },
        {
          text: "C- 9",
          isCorrect: false
        },
        {
          text: "D- 10",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quelle planète est surnommée 'la planète rouge' ?",
      answers: [
        {
          text: "A- Jupiter",
          isCorrect: false
        },
        {
          text: "B- Mars ",
          isCorrect: true
        },
        {
          text: "C- Saturne",
          isCorrect: true
        },
        {
            text: "D- Neptune",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quelle est la plus grande planète du Système solaire ?",
      answers: [
        {
          text: "A- Mars",
          isCorrect: false
        },
        {
          text: "B- Uranus",
          isCorrect: false
        },
        {
          text: "C- Jupiter",
          isCorrect: true
        },
        {
          text: "D- Saturne",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quelle étoile est la plus proche de la Terre après le Soleil ?",
      answers: [
        {
          text: "A- Sirius", 
          isCorrect: false
        },
        {
          text: "B- Alpha du Centaure",
          isCorrect: true
        },
        {
          text: "C- Bételgeuse",
          isCorrect: false
        },
        {
          text: "D- Véga",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quelle planète a des anneaux visibles depuis la Terre ?",
      answers: [
          {
            text: "A- Uranus",
            isCorrect: false
          },
          {
            text: "B- Saturne ",
            isCorrect: true
          },
          {
            text: "C- Neptune",
            isCorrect: false
          },
          {
              text: "D- Mercure",
              isCorrect: false
          }
        ]
      },
      {
        text: "Qui a été le premier homme à marcher sur la Lune ?",
        answers: [
          {
            text: "A- Buzz Aldrin",
            isCorrect: false
          },
          {
            text: "B- Neil Armstrong",
            isCorrect: true
          },
          {
            text: "C- Yuri Gagarine",
            isCorrect: false
          },
          {
            text: "D- Michael Collins",
            isCorrect: false
          }
        ]
      },
      {
        text: "De quoi sont principalement composées les étoiles ?",
        answers: [
          {
            text: "A- Fer et nickel",
            isCorrect: false
          },
          {
            text: "B- Hydrogène et hélium",
            isCorrect: true
          },
          {
            text: "C- Carbone et oxygène",
            isCorrect: false
          },
          {
              text: "D- Azote et méthane",
              isCorrect: false
          }
        ]
      },
      {
        text: "Quelle planète a un grand anticyclone appelé 'la Grande Tache Rouge' ?",
        answers: [
          {
            text: "A- Mars",
            isCorrect: false
          },
          {
            text: "B- Jupiter",
            isCorrect: true
          },
          {
            text: "C- Neptune",
            isCorrect: false
          },
          {
            text: "D- Saturne",
            isCorrect: false
          }
        ]
      },
      {
        text: "Quelle est la mission spatiale qui a permis d’observer Pluton de près en 2015 ?",
        answers: [
          {
            text: "A-  Voyager 2",
            isCorrect: false
          },
          {
            text: "B- SCuriosity",
            isCorrect: true
          },
          {
            text: "C- New Horizons",
            isCorrect: false
          },
          {
            text: "D- Galileo",
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