<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> Quiz_App - Start</title>
      <link rel="stylesheet" href="style.css"/>
   </head>
   <body>
      <nav class="nav">
         <div class="nav-button">
            <button class="btn" id="registrationBtn" onclick="logout()">Logout</button>
         </div>
         <div class="nav-menu" id="navMenu">
            <ul>
               <li><a href="about-page.html" class="link active">About</a></li>
               <li><a href="quiz-page.html" class="link">Restart Quiz</a></li>
            </ul>
         </div>
      </nav>
      <div class="container">
      <div id="question" class="justify-center flex-column">
         <div id="hub">
            <div id="hub-element">
               <p class="hub-prefix">
                  Question
               </p>
               <h1 class="hub-text" id="numberOfQuestions"> 1 of 8</h1>
            </div>
            <div id="hub-element">
               <p class="hub-prefix">
                  Score
               </p>
               <h1 class="hub-text" id="value">0</h1>
            </div>
            <div class="quiz_timer">
               <div class="time">
                  <div class="time_text" id="time_text">Seconds</div>
                  <div class="time_seconds" id="time_seconds">180</div>
               </div>
            </div>
         </div>
         <div id="Question" class="justify-center flex-column">
            <h2 id="questions">What is the answer for the question?</h2>
            <div class="choice_container">
               <p class="choice_text" data-element="1"></p>
            </div>
            <div class="choice_container">
               <p class="choice_text" data-element="2"></p>
            </div>
            <div class="choice_container">
               <p class="choice_text" data-element="3"></p>
            </div>
            <div class="choice_container">
               <p class="choice_text" data-element="4"></p>
            </div>
         </div>
      </div>
      <footer>
         <p>&copy; 2024 Quiz App</p>
      </footer>
      <script src="question.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="logout.js"></script>
   </body>
</html>
