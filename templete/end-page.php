<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Quiz - Final Score</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="about-page.html" class="link">About</a></li>
                    <li><a href="quiz-page.html" class="link active">Quiz</a></li>
                </ul>
            </div>
</nav>
    <div class="container">
        <div id="last" class="flex-center flex-column">
            <a class="button white-btn" href="question-page.php">Try Again</a>
            <!-- <h1 class="button" id="TotalScore"><?php $_SESSION['score']?></h1> -->
            <a class="button white-btn" href="index-page.html">Back to Home</a>
        </div>
    </div>

    <script src="end-page.js"></script>
</body>
</html>
