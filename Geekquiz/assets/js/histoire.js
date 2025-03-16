let questionsList = [
    {
    text: " Question : Quel événement a marqué la fin de la République romaine ?",
    answers: [
        {
          text: "A- La bataille de Pharsale ",
          isCorrect: false
        },
        {
          text: "B- L'assassinat de Jules César",
          isCorrect: true
        },
        {
          text: " C- Le premier voyage de César en Gaule",
          isCorrect: false
        },
        {
            text: " D- La fondation de Constantinople ",
            isCorrect: false
        }
      ]
    },
    {
      text: "Qui est considéré comme le fondateur légendaire de Rome ?",
      answers: [
        {
          text: "A- Remus",
          isCorrect: false
        },
        {
          text: "B- Romulus",
          isCorrect: true
        },
        {
          text: "C- Jules César",
          isCorrect: false
        },
        {
          text: "D- Auguste",
          isCorrect: false
        }
      ]
    },
    {
      text: "En quelle année marque traditionnellement la fondation de Rome ?",
      answers: [
        {
          text: "A- 753 av. J.-C.",
          isCorrect: true
        },
        {
          text: "B- 509 av. J.-C.",
          isCorrect: false
        },
        {
          text: "C- 27 av. J.-C.",
          isCorrect: false
        },
        {
            text: "D- 476 ap. J.-C.",
            isCorrect: false
        }
      ]
    },
    {
      text: "Qui a été le premier empereur de Rome ?",
      answers: [
        {
          text: "A- Jules César",
          isCorrect: false
        },
        {
          text: "B- Néron",
          isCorrect: false
        },
        {
          text: "C- Auguste",
          isCorrect: true
        },
        {
          text: "D- Caligula",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quelle guerre a opposé Rome à Carthage ?",
      answers: [
        {
          text: "A- Les Guerres Gaiques",
          isCorrect: false
        },
        {
          text: "B- Les Guerres puniques",
          isCorrect: true
        },
        {
          text: "C- La Guerre des Gaules",
          isCorrect: false
        },
        {
          text: "D- Les Guerres civiles romaines",
          isCorrect: false
        }
      ]
    },
    {
      text: " Quel était le rôle des aqueducs dans la Rome antique ?",
      answers: [
          {
            text: "A- Transporter les marchandises",
            isCorrect: false
          },
          {
            text: "B- Fournir de l'eau aux villes",
            isCorrect: true
          },
          {
            text: "C- Servir de fortifications",
            isCorrect: false
          },
          {
              text: "D- Accueillir des spectacles",
              isCorrect: false
          }
        ]
      },
      {
        text: "Quelle langue était la langue officielle de la Rome antique ?",
        answers: [
          {
            text: "A- Le grec",
            isCorrect: false
          },
          {
            text: "B- L'étrusque",
            isCorrect: false
          },
          {
            text: "C- Le latin",
            isCorrect: true
          },
          {
            text: "D- Le gaulois",
            isCorrect: false
          }
        ]
      },
      {
        text: "Qui était le dernier empereur romain d'Occident ?",
        answers: [
          {
            text: "A- Constantin XI",
            isCorrect: false
          },
          {
            text: "B- Romulus Augustule",
            isCorrect: true
          },
          {
            text: "C- Jules Nepos",
            isCorrect: false
          },
          {
              text: "D- Honorius",
              isCorrect: false
          }
        ]
      },
      {
        text: "En quelle année l'Empire romain d'Occident est-il traditionnellement considéré comme ayant pris fin ?",
        answers: [
          {
            text: "A- 313 ap. J.-C.",
            isCorrect: false
          },
          {
            text: "B- 395 ap. J.-C.",
            isCorrect: false
          },
          {
            text: "C- 410 ap. J.-C.",
            isCorrect: false
          },
          {
            text: "D- 476 ap. J.-C.",
            isCorrect: true
          }
        ]
      },
      {
        text: "Quelle ville Constantin a-t-il choisie comme nouvelle capitale de l'Empire romain, la renommant Constantinople ?",
        answers: [
          {
            text: "A- Rome",
            isCorrect: false
          },
          {
            text: "B- Alexandrie",
            isCorrect: false
          },
          {
            text: "C- Byzance",
            isCorrect: true
          },
          {
            text: "D- Antioche",
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