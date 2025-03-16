let questionsList = [
    {
    text: "Quelle distance sépare le point de penalty du but ?",
    answers: [
        {
          text: "A- 9,15 mètres",
          isCorrect: false
        },
        {
          text: "B- 11 mètres",
          isCorrect: true
        },
        {
          text: " C- 12 mètres",
          isCorrect: false
        },
        {
            text: " D- 13 mètres",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quelle nation a remporté la Coupe du Monde 2018 ?",
      answers: [
        {
          text: "A-  Argentine",
          isCorrect: false
        },
        {
          text: "B- Brésil",
          isCorrect: false
        },
        {
          text: "C- France ",
          isCorrect: true
        },
        {
          text: "D- Allemagne",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel joueur a remporté le plus de Ballons d'Or en 2023 ?",
      answers: [
        {
          text: "A- Lionel Messi",
          isCorrect: true
        },
        {
          text: "B- Cristiano Ronaldo",
          isCorrect: false
        },
        {
          text: "C- Pelé",
          isCorrect: false
        },
        {
            text: "D- Robert Lewandowski",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le club le plus titré en Ligue des Champions ?",
      answers: [
        {
          text: "A- FC Barcelone",
          isCorrect: false
        },
        {
          text: "B- AC Milan",
          isCorrect: false
        },
        {
          text: "C- Manchester United",
          isCorrect: false
        },
        {
          text: "D- Real Madrid",
          isCorrect: true
        }
      ]
    },
    {
      text: "Quel joueur a inscrit le but de la victoire pour l'Allemagne en finale de la Coupe du Monde 2014 ?",
      answers: [
        {
          text: "A- Miroslav Klose", 
          isCorrect: false
        },
        {
          text: "B- Thomas Müller",
          isCorrect: false
        },
        {
          text: "C- Mario Götze",
          isCorrect: true
        },
        {
          text: "D- Mesut Özil",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel club a remporté la Premier League en 2022-2023 ?",
      answers: [
          {
            text: "A- Manchester United",
            isCorrect: false
          },
          {
            text: "B- Liverpool",
            isCorrect: false
          },
          {
            text: "C- Manchester City",
            isCorrect: true
          },
          {
              text: "D- Arsenal",
              isCorrect: false
          }
        ]
      },
      {
        text: "Qui détient le record du plus grand nombre de buts en sélection nationale ?",
        answers: [
          {
            text: "A- Cristiano Ronaldo",
            isCorrect: true
          },
          {
            text: "B- Pelé",
            isCorrect: false
          },
          {
            text: "C- Lionel Messi",
            isCorrect: false
          },
          {
            text: "D- Neymar",
            isCorrect: false
          }
        ]
      },
      {
        text: "Quel pays a organisé la Coupe du Monde 2022 ?",
        answers: [
          {
            text: "A- Russie",
            isCorrect: false
          },
          {
            text: "B- États-Unis",
            isCorrect: false
          },
          {
            text: "C- Qatar",
            isCorrect: true
          },
          {
              text: "D- Brésil",
              isCorrect: false
          }
        ]
      },
      {
        text: "Quel joueur a marqué le plus de buts en une seule saison de Ligue des Champions ?",
        answers: [
          {
            text: "A- Karim Benzema",
            isCorrect: false
          },
          {
            text: "B- Cristiano Ronaldo",
            isCorrect: true
          },
          {
            text: "C- Lionel Messi",
            isCorrect: false
          },
          {
            text: "D- Robert Lewandowski",
            isCorrect: false
          }
        ]
      },
      {
        text: "En quelle année a été créée la FIFA ?",
        answers: [
          {
            text: "A- 1904 ",
            isCorrect: true
          },
          {
            text: "B- 1920",
            isCorrect: false
          },
          {
            text: "C- 1930",
            isCorrect: false
          },
          {
            text: "D- 1945",
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