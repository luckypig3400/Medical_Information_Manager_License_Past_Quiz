const question = document.getElementById('question');
const choices = Array.from(document.getElementsByClassName('choice-text'));
const progressText = document.getElementById('progressText');
const scoreText = document.getElementById('score');
const progressBarFull = document.getElementById('progressBarFull');
const loader = document.getElementById('loader');
const game = document.getElementById('game');
let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuesions = [];

let questions = [];

const fullURL = window.location.href;
// https://stackoverflow.com/questions/1034621/get-the-current-url-with-javascript

let getParameters = "";
if (fullURL.indexOf("?") == -1) {
    getParameters = "?limit=6&random=true";//提供預設GET參數
} else {
    getParameters = fullURL.slice(fullURL.indexOf("?"));
    // https://www.w3schools.com/jsref/jsref_indexof.asp
}

const requestURL = './../model/fetchPublicDB.php' + getParameters;

fetch(
    // 'https://opentdb.com/api.php?amount=10&category=9&difficulty=easy&type=multiple'
    requestURL
)
    .then((res) => {
        const docs = res.json();
        return docs;
    })
    .then((loadedQuestions) => {
        // console.log("Full JSON data:" + loadedQuestions.results);
        questions = loadedQuestions.results.map((loadedQuestion) => {
            const formattedQuestion = {
                question: loadedQuestion.Question,
            };

            const answerChoices = [loadedQuestion.Answer1, loadedQuestion.Answer2, loadedQuestion.Answer3, loadedQuestion.Answer4];
            //Replace String: https://www.w3schools.com/jsref/jsref_replace.asp
            correctAnswers = loadedQuestion.Correct_Answers.replace("Ans", "");
            formattedQuestion.answer = correctAnswers.split("、");// Handle Multiple Correct Answers
            //Split String: https://www.w3schools.com/jsref/jsref_split.asp
            // console.log(formattedQuestion.answer);

            answerChoices.forEach((choice, index) => {
                formattedQuestion['choice' + (index + 1)] = choice;
            });

            return formattedQuestion;
        });

        startGame();
    })
    .catch((err) => {
        console.log("Error occured while loading json data:" + err);
    });

//global variables
var MAX_QUESTIONS = 3;
var CORRECT_BONUS = 10;

startGame = () => {
    questionCounter = 0;
    availableQuesions = [...questions];
    MAX_QUESTIONS = availableQuesions.length;
    CORRECT_BONUS = parseInt(100 / MAX_QUESTIONS);
    score = 100 % MAX_QUESTIONS;
    // console.log([...questions]);//Show all questions & answer
    getNewQuestion();
    game.classList.remove('hidden');
    loader.classList.add('hidden');
};

getNewQuestion = () => {
    if (availableQuesions.length === 0 || questionCounter >= MAX_QUESTIONS) {
        localStorage.setItem('mostRecentScore', score);
        //go to the end page
        return window.location.assign('./end.html');
    }
    questionCounter++;
    progressText.innerText = `Question ${questionCounter}/${MAX_QUESTIONS}`;
    //Update the progress bar
    progressBarFull.style.width = `${(questionCounter / MAX_QUESTIONS) * 100}%`;

    // const questionIndex = Math.floor(Math.random() * availableQuesions.length);
    // 上面這行為打亂題號，但是gameConfig裡已有提供相同功能，故在此禁用
    const questionIndex = 0;
    currentQuestion = availableQuesions[questionIndex];
    question.innerHTML = currentQuestion.question;

    choices.forEach((choice) => {
        const number = choice.dataset['number'];
        choice.innerHTML = currentQuestion['choice' + number];
    });

    availableQuesions.splice(questionIndex, 1);
    acceptingAnswers = true;
};

choices.forEach((choice) => {
    choice.addEventListener('click', (e) => {
        if (!acceptingAnswers) return;
        acceptingAnswers = false;
        const selectedChoice = e.target;
        const selectedAnswer = selectedChoice.dataset['number'];

        var classToApply = 'incorrect';
        for (let i = 0; i < currentQuestion.answer.length; i++) {
            if (selectedAnswer == currentQuestion.answer[i]) classToApply = 'correct';
        }

        if (classToApply === 'correct') {
            incrementScore(CORRECT_BONUS);
        }

        selectedChoice.parentElement.classList.add(classToApply);

        setTimeout(() => {
            selectedChoice.parentElement.classList.remove(classToApply);
            getNewQuestion();
        }, 1000);
    });
});

incrementScore = (num) => {
    score += num;
    scoreText.innerText = score;
};
