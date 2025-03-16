let questionsList = [
    {
    text: "Comment s'appelle le grand père de Yuiji Itadori ?",
    answers: [
        {
          text: "A- Yaga Masamichi",
          isCorrect: false
        },
        {
          text: "B- Megumi Fushiguro",
          isCorrect: false
        },
        {
          text: " C- Jin Itadori",
          isCorrect: false
        },
        {
            text: " D- Wasuke itadori",
            isCorrect: true
        }
      ]
    },
    {
      text: "Dans quel lycée Yuiji Itadori est il scolarisé ?",
      answers: [
        {
          text: "A- Lycée de Tokyo",
          isCorrect: false
        },
        {
          text: "B- Lycée Sugisawa3",
          isCorrect: true
        },
        {
          text: "C- Lycée Sendai1",
          isCorrect: false
        },
        {
          text: "D- Lycée Nagoya",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de la Premiere technique de combat de Yuiji Itadori ?",
      answers: [
        {
          text: "A- Coup de poing fluctuant",
          isCorrect: false
        },
        {
          text: "B- Coup de l'interval",
          isCorrect: true
        },
        {
          text: "C- Detroit smash",
          isCorrect: false
        },
        {
            text: "D- Coup de poing du dragon",
            isCorrect: false
        }
      ]
    },
    {
      text: "Commment s'appelle le directeur du lycée d'exorcisme de Tokyo ?",
      answers: [
        {
          text: "A- Satoru Gojo",
          isCorrect: false
        },
        {
          text: "B- Mei Mei",
          isCorrect: false
        },
        {
          text: "C- Masamichi Yaga",
          isCorrect: true
        },
        {
          text: "D- Kento Nanami",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est etait le record de rayon noir de Kento Nanami?",
      answers: [
        {
          text: "A- 5", 
          isCorrect: false
        },
        {
          text: "B- 21",
          isCorrect: false
        },
        {
          text: "C- 9",
          isCorrect: false
        },
        {
          text: "D- 4",
          isCorrect: true
        }
      ]
    },
    {
      text: "De quoi né les fleaux ?",
      answers: [
          {
            text: "A- Les emotions négatives des humains",
            isCorrect: true
          },
          {
            text: "B- Les sentiments positives des humains",
            isCorrect: true
          },
          {
            text: "C- Malformations des humains",
            isCorrect: false
          },
          {
              text: "D- Les humains eux même",
              isCorrect: false
          }
        ]
      },
      {
        text: "Quel est le nom de se familier dont Megumi Fushiguro fait appel pour ce battre contre Sukuna?",
        answers: [
          {
            text: "A- Nue",
            isCorrect: false
          },
          {
            text: "B- Chien de jade",
            isCorrect: false
          },
          {
            text: "C- Mahoraga",
            isCorrect: true
          },
          {
            text: "D- Elephant de plenitude",
            isCorrect: false
          }
        ]
      },
      {
        text: "Combien de temps Gojo demande a yuji de laisser sukuruna prendre le controle de son corps?",
        answers: [
          {
            text: "A- 10 secondes",
            isCorrect: true
          },
          {
            text: "B- 18 secondes",
            isCorrect: false
          },
          {
            text: "C- 30 secondes",
            isCorrect: false
          },
          {
              text: "D- 1 minute",
              isCorrect: false
          }
        ]
      },
      {
        text: "Après tout les combiens d'annés tengen a besoin de changer de corps?",
        answers: [
          {
            text: "A- 5 ans",
            isCorrect: false
          },
          {
            text: "B- 350 ans",
            isCorrect: false
          },
          {
            text: "C- 500ans",
            isCorrect: true
          },
          {
            text: "D- 1000ans",
            isCorrect: false
          }
        ]
      },
      {
        text: "Comment s'appelle cette technique que sukuna utilise pour battre Mahoraga?",
        answers: [
          {
            text: "A- Coup de poing du dragon",
            isCorrect: false
          },
          {
            text: "B- Ouverture",
            isCorrect: true
          },
          {
            text: "C- Fuga",
            isCorrect: true
          },
          {
            text: "D- Autel demoniaque",
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