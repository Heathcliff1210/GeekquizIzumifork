let questionsList = [
    {
      text: "Quel est le nom du groupe de musique qui a sorti l'album 'Sgt. Pepper's Lonely Hearts Club Band' ?",
      answers: [
        {
          text: "A- The Beatles",
          isCorrect: true
        },
        {
          text: "B- The Rolling Stones",
          isCorrect: false
        },
        {
          text: "C- The Who",
          isCorrect: false
        },
        {
          text: "D- The Beach Boys",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du chanteur qui a sorti l'album 'Thriller' ?",
      answers: [
        {
          text: "A- Michael Jackson",
          isCorrect: true
        },
        {
          text: "B- Elvis Presley",
          isCorrect: false
        },
        {
          text: "C- John Lennon",
          isCorrect: false
        },
        {
          text: "D- Paul McCartney",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du groupe de musique qui a sorti l'album 'Dark Side of the Moon' ?",
      answers: [
        {
          text: "A- Pink Floyd",
          isCorrect: true
        },
        {
          text: "B- Led Zeppelin",
          isCorrect: false
        },
        {
          text: "C- Queen",
          isCorrect: false
        },
        {
          text: "D- AC/DC",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du chanteur qui a sorti l'album 'Purple Rain' ?",
      answers: [
        {
          text: "A- Prince",
          isCorrect: true
        },
        {
          text: "B- David Bowie",
          isCorrect: false
        },
        {
          text: "C- Elton John",
          isCorrect: false
        },
        {
          text: "D- Stevie Wonder",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du groupe de musique qui a sorti l'album 'Hotel California' ?",
      answers: [
        {
          text: "A- Eagles",
          isCorrect: true
        },
        {
          text: "B- Fleetwood Mac",
          isCorrect: false
        },
        {
          text: "C- The Doors",
          isCorrect: false
        },
        {
          text: "D- Aerosmith",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du chanteur qui a sorti l'album 'Bad' ?",
      answers: [
        {
          text: "A- Michael Jackson",
          isCorrect: true
        },
        {
          text: "B- Prince",
          isCorrect: false
        },
        {
          text: "C- Whitney Houston",
          isCorrect: false
        },
        {
          text: "D- George Michael",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du groupe de musique qui a sorti l'album 'Back in Black' ?",
      answers: [
        {
          text: "A- AC/DC",
          isCorrect: true
        },
        {
          text: "B- Guns N' Roses",
          isCorrect: false
        },
        {
          text: "C- Van Halen",
          isCorrect: false
        },
        {
          text: "D- Def Leppard",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du chanteur qui a sorti l'album 'Like a Prayer' ?",
      answers: [
        {
          text: "A- Madonna",
          isCorrect: true
        },
        {
          text: "B- Janet Jackson",
          isCorrect: false
        },
        {
          text: "C- Whitney Houston",
          isCorrect: false
        },
        {
          text: "D- Mariah Carey",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du groupe de musique qui a sorti l'album 'Nevermind' ?",
      answers: [
        {
          text: "A- Nirvana",
          isCorrect: true
        },
        {
          text: "B- Pearl Jam",
          isCorrect: false
        },
        {
          text: "C- Radiohead",
          isCorrect: false
        },
        {
          text: "D- Foo Fighters",
          isCorrect: false
        }
      ]
    },
    {
      text: "Quel est le nom du chanteur qui a sorti l'album 'The Bodyguard' ?",
      answers: [
        {
          text: "A- Whitney Houston",
          isCorrect: true
        },
        {
          text: "B- Mariah Carey",
          isCorrect: false
        },
        {
          text: "C- Celine Dion",
          isCorrect: false
        },
        {
          text: "D- Shania Twain",
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