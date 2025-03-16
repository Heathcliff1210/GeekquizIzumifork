let questionsList = [
    {
    text: "Quel est le jeu vidéo le plus vendu de tous les temps ?",
    answers: [
        {
          text: "A- Grand Theft Auto V",
          isCorrect: false
        },
        {
          text: "B- Tetris",
          isCorrect: false
        },
        {
          text: " C- Minecraft",
          isCorrect: true
        },
        {
            text: " D- Super Mario Bros",
            isCorrect: false
        }
      ]
    },
    {
      text: "Dans quelle série de jeux vidéo trouve-t-on le personnage de Master Chief ?",
      answers: [
        {
          text: "A- Call of Duty",
          isCorrect: false
        },
        {
          text: "B- Halo",
          isCorrect: true
        },
        {
          text: "C- Doom",
          isCorrect: false
        },
        {
          text: "D- Destiny",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le studio de développement derrière la saga The Legend of Zelda ?",
      answers: [
        {
          text: "A- Square Enix",
          isCorrect: false
        },
        {
          text: "B- Ubisoft",
          isCorrect: false
        },
        {
          text: "C- Nintendo",
          isCorrect: true
        },
        {
            text: "D- Capcom",
            isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du protagoniste principal de la série God of War ?",
      answers: [
        {
          text: "A- Zeus",
          isCorrect: false
        },
        {
          text: "B- Kratos",
          isCorrect: true
        },
        {
          text: "C- Ares",
          isCorrect: false
        },
        {
          text: "D- Hades",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel jeu a popularisé le genre 'Battle Royale' ?",
      answers: [
        {
          text: "A- Call of Duty: Warzone", 
          isCorrect: false
        },
        {
          text: "B- Apex Legends",
          isCorrect: false
        },
        {
          text: "C- Fortnite",
          isCorrect: false
        },
        {
          text: "D- PUBG",
          isCorrect: true
        }
      ]
    },
    {
      text: "Que signifie 'MMORPG' ?",
      answers: [
          {
            text: "A- Massive Multiplayer Online Role-Playing Game",
            isCorrect: true
          },
          {
            text: "B- Mega Multiplayer Online Racing Game",
            isCorrect: false
          },
          {
            text: "C- Multi Mode Online Role-Playing Game",
            isCorrect: false
          },
          {
              text: "D- Massive Multiplayer Offline Racing Game",
              isCorrect: false
          }
        ]
      },
      {
        text: "Quelle est la date de sortie de la première PlayStation ?",
        answers: [
          {
            text: "A- 1992",
            isCorrect: false
          },
          {
            text: "B- 1994",
            isCorrect: true
          },
          {
            text: "C- 1996",
            isCorrect: false
          },
          {
            text: "D- 1998",
            isCorrect: false
          }
        ]
      },
      {
        text: "Quel personnage est la mascotte de SEGA ?",
        answers: [
          {
            text: "A- Sonic",
            isCorrect: true
          },
          {
            text: "B- Mario",
            isCorrect: false
          },
          {
            text: "C- Crash Bandicoot",
            isCorrect: false
          },
          {
              text: "D- Donkey Kong",
              isCorrect: false
          }
        ]
      },
      {
        text: "Dans quel jeu trouve-t-on l’île de Los Santos ?",
        answers: [
          {
            text: "A- Red Dead Redemption",
            isCorrect: false
          },
          {
            text: "B- Grand Theft Auto V",
            isCorrect: true
          },
          {
            text: "C- Mafia III",
            isCorrect: false
          },
          {
            text: "D- Just Cause",
            isCorrect: false
          }
        ]
      },
      {
        text: "Qui est le créateur de Super Mario ?",
        answers: [
          {
            text: "A- Hideo Kojima",
            isCorrect: false
          },
          {
            text: "B- Shigeru Miyamoto",
            isCorrect: true
          },
          {
            text: "C- Masahiro Sakurai",
            isCorrect: false
          },
          {
            text: "D- Satoru Iwata",
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