<!DOCTYPE html>

<!-- To Use Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<html>
    <head>
        <title>Jason Willis Online Portfolio</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #1a1a1a;
                color: #e6e6e6;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 100px auto;
                padding: 20px;
                background-color: #333;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 5px;
            }
            h1 {
                text-align: center;
                margin-bottom: 30px;
                color: #fff;
            }
            p {
                line-height: 1.6;
                margin-bottom: 20px;
            }
            a {
                color: #007bff;
            }
        </style>
    </head>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="#">Navigation:</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="resume.html">Resume</a></li>
                <li class="nav-item"><a class="nav-link" href="projects.html"><b>Projects</b></a></li>
            </ul>
        </div>
    </nav>
    <body>
        <div class="container">
            <h1>Welcome to Jason Willis' Project Page</h1>
            <p>This is where I will display the projects I've worked on. This page is in progress and the first project is not yet complete but it will be a hangman game
        </div>
        <h1>Hangman Game</h1>

    <?php
    // Initialize variables
    $word = '';
    $guessedWord = '';
    $maxAttempts = 6;
    $attempts = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['start'])) {
            // Start the game
            $word = strtoupper($_POST['word']);
            $guessedWord = str_repeat('_', strlen($word));
            $attempts = 0;
        } else if (isset($_POST['guess'])) {
            // Process a guess
            $word = strtoupper($_POST['word']);
            $guessedWord = $_POST['guessedWord'];
            $guess = strtoupper($_POST['guess']);

            if (strpos($word, $guess) !== false) {
                // Update guessed word with correctly guessed letter(s)
                for ($i = 0; $i < strlen($word); $i++) {
                    if ($word[$i] === $guess) {
                        $guessedWord[$i] = $guess;
                    }
                }
            } else {
                $attempts++;
            }
        } else if (isset($_POST['reset'])) {
            // Reset the game
            $word = '';
            $guessedWord = '';
            $attempts = 0;
        }
    }
    ?>

    <form method="post">
        <label for="word">Enter the word to guess:</label>
        <input type="text" name="word" id="word" value="<?php echo $word; ?>" required>
        <br>
        <label for="guessedWord">Guessed word:</label>
        <input type="text" name="guessedWord" id="guessedWord" value="<?php echo $guessedWord; ?>" readonly>
        <br>
        <label for="guess">Enter your guess:</label>
        <input type="text" name="guess" id="guess" required>
        <input type="submit" value="Guess">
        <input type="submit" name="start" value="Start">
        <input type="submit" name="reset" value="Reset">
    </form>

    <?php
    // Hangman image
    $hangmanImages = [
        'head', 'body', 'left_arm', 'right_arm', 'left_leg', 'right_leg'
    ];

    if ($attempts > 0) {
        echo '<h2>Attempts Remaining: ' . ($maxAttempts - $attempts) . '</h2>';
    }

    echo '<img src="hangman_images/' . ($attempts > 0 ? $hangmanImages[$attempts - 1] : 'base') . '.png" alt="Hangman Image">';
    ?>
    </body>
    </html>