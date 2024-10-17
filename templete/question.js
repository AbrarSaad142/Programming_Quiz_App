const questionelement = document.getElementById("questions");
const Elements = Array.from(document.getElementsByClassName("choice_text"));
const numberOfQuestionscount = document.getElementById("numberOfQuestions");
const scorevalue =  document.getElementById("value");
const questionTimer = document.getElementById("time_seconds");
let Answer = false;
var score = 0;
let numberOfQuestions = 0;
let newQuestions = [];
let currentQuestion = 1;
let timeLeft = 180;

const Questions = [
     {
        Question: "What Does HTML Stands For?",
        choice1: "HyperText Markup Language",
        choice2: "HyperText Manipulation Language",
        choice3: "Hyperlink Text Markup Language",
        choice4: "Hyperlinks and Text Markup Language",
        Answer: 1
    },
    {
        Question: "Who is the father of C language?",
        choice1: "Dennis Ritchie",
        choice2: "Rasmus Lerdorf",
        choice3: "James Gosling",
        choice4: "Steve Jobs",
        Answer: 1
    },
    {
        Question: "What is an example of iteration in C?",
        choice1: "While",
        choice2: "For",
        choice3: "Do-while",
        choice4: "All of the above",
        Answer: 4
    },
    {
        Question: "C preprocessors can have compiler specific features?",
        choice1: "True",
        choice2: "False",
        choice3: "Depends on the standard",
        choice4: "Depends on the platform",
        Answer: 1
    },
    {
        Question: "What is a correct syntax to output Hello World in Python?",
        choice1: "echo Hello World",
        choice2: "print(Hello World)",
        choice3: "echo (Hello World)",
        choice4: "printf(Hello World)",
        Answer: 2
    },
    {
        Question: "How do you insert COMMENTS in Python?",
        choice1: "#This is a comment",
        choice2: "//This is a comment",
        choice3: "//This is a comment//",
        choice4: "/*This is a comment*/",
        Answer: 1
    },
    {
        Question: "What does SQL stand for?",
        choice1: "Structured Query Language",
        choice2: "System Query Language",
        choice3: "Strong Question Language",
        choice4: "Structured Question Language",
        Answer: 1
    },
    {
        Question: "Which SQL statement is used to update data in a database?",
        choice1: "SAVE",
        choice2: "UPDATE",
        choice3: "INSERT",
        choice4: "SAVE AS",
        Answer: 2
    }
];
const Bouns = 1;
const Max_Num = 8;
const startQuiz = () => {
    numberOfQuestions = 0;
    score = 0;
    newQuestions = [...Questions];
    getNewQuestion();
};

const getNewQuestion = () => {
    if (newQuestions.length === 0 || numberOfQuestions >= Max_Num) {
        return window.location.assign('end-page.php');
    }

    numberOfQuestions++;
    numberOfQuestionscount.innerText = `${numberOfQuestions} of ${Max_Num}`;

    const questionIndex = Math.floor(Math.random() * newQuestions.length);
    currentQuestion = newQuestions[questionIndex];

    questionelement.innerText = currentQuestion.Question;

    Elements.forEach(choice => {
        const element = choice.dataset['element'];
        choice.innerText = currentQuestion["choice" + element];
    });

    newQuestions.splice(questionIndex, 1);
    Answer = true;
};

Elements.forEach(choice => {
    choice.addEventListener("click", (e) => {
        if (!Answer)
            return;

        Answer = false;

        const selectedChoice = e.target;
        const selectedAnswer = parseInt(selectedChoice.dataset["element"]);
        const correctAnswer = currentQuestion.Answer;
        const apply = selectedAnswer === correctAnswer ? "correct" : "incorrect";
            if (apply === 'correct') {
                     valueofScore(Bouns);
            }

        selectedChoice.parentElement.classList.add(apply);

        setTimeout(() => {
            selectedChoice.parentElement.classList.remove(apply);
            getNewQuestion();
        }, 1000);
    });
});

const valueofScore = (val) => {
    score += val;
    scorevalue.innerText = score;
};

const timer = setInterval(() => {
    timeLeft--;
    questionTimer.innerText = timeLeft;
    if (timeLeft <= 0) {
        console.log(score);
        
        clearInterval(timer);
            $.ajax({
                url: 'updateScore.php',
                method: 'POST',
                data:{score: score},
                success: function() {
                    // window.location.href = 'end-page.php';
                },
                error: function() {
                    alert('Logout failed. Please try again.');
                }
            });
    }
}, 1000);

startQuiz();                                                                   
