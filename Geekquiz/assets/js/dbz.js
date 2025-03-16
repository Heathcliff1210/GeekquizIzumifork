let questionsList = [
    {
      text: "Quel est le nom du protagoniste principal de la série Dragon Ball ?",
      answers: [
        {
          text: "A- Goku",
          isCorrect: true
        },
        {
          text: "B- Vegeta",
          isCorrect: false
        },
        {
          text: "C- Trunks",
          isCorrect: false
        },
        {
          text: "D- Piccolo",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du premier ennemi principal de la série Dragon Ball ?",
      answers: [
        {
          text: "A- Emperor Pilaf",
          isCorrect: true
        },
        {
          text: "B- Frieza",
          isCorrect: false
        },
        {
          text: "C- Cell",
          isCorrect: false
        },
        {
          text: "D- Buu",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de la technique de combat utilisée par Goku pour vaincre Frieza ?",
      answers: [
        {
          text: "A- Kamehameha",
          isCorrect: true
        },
        {
          text: "B- Dragon Fist",
          isCorrect: false
        },
        {
          text: "C- Big Bang Attack",
          isCorrect: false
        },
        {
          text: "D- Spirit Bomb",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du planète où Goku et ses amis se rendent pour chercher les Dragon Balls ?",
      answers: [
        {
          text: "A- Namek",
          isCorrect: true
        },
        {
          text: "B- Vegeta",
          isCorrect: false
        },
        {
          text: "C- Trunks",
          isCorrect: false
        },
        {
          text: "D- Earth",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du personnage qui devient le nouveau dieu de la destruction après la défaite de Beerus ?",
      answers: [
        {
          text: "A- Whis",
          isCorrect: false
        },
        {
          text: "B- Beerus",
          isCorrect: false
        },
        {
          text: "C- Champa",
          isCorrect: false
        },
        {
          text: "D- Vegeta",
          isCorrect: true
        }
      ]
    },
    {
      text: "Quel est le nom de la forme de combat que Goku atteint après avoir dépassé la limite de la forme de Super Saiyan ?",
      answers: [
        {
          text: "A- Ultra Instinct",
          isCorrect: true
        },
        {
          text: "B- Super Saiyan God",
          isCorrect: false
        },
        {
          text: "C- Super Saiyan Blue",
          isCorrect: false
        },
        {
          text: "D- Kaio-ken",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du tournoi organisé par les dieux de la destruction pour déterminer le plus fort univers ?",
      answers: [
        {
          text: "A- Tournoi des dieux de la destruction",
          isCorrect: false
        },
        {
          text: "B- Tournoi de la puissance",
          isCorrect: true
        },
        {
          text: "C- Tournoi des univers",
          isCorrect: false
        },
        {
          text: "D- Tournoi des guerriers",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du personnage qui est le premier à utiliser la technique de l'Ultra Instinct ?",
      answers: [
        {
          text: "A- Whis",
          isCorrect: true
        },
        {
          text: "B- Beerus",
          isCorrect: false
        },
        {
          text: "C- Goku",
          isCorrect: false
        },
        {
          text: "D- Vegeta",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom de la planète où se déroule le tournoi de la puissance ?",
      answers: [
        {
          text: "A- Namek",
          isCorrect: false
        },
        {
          text: "B- Earth",
          isCorrect: false
        },
        {
          text: "C- Zeno",
          isCorrect: false
        },
        {
          text: "D- Null Realm",
          isCorrect: true
        }
      ]
    },
    {
      text: "Quel est le nom du personnage qui remporte le tournoi de la puissance ?",
      answers: [
        {
          text: "A- Goku",
          isCorrect: false
        },
        {
          text: "B- Vegeta",
          isCorrect: false
        },
        {
          text: "C- Frieza",
          isCorrect: false
        },
        {
          text: "D- Android 17",
          isCorrect: true
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