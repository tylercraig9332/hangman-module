<?php

if (!defined('PHPWS_SOURCE_DIR')) {
    include '../../core/conf/404.html';
    exit();
}


\phpws\PHPWS_Core::initModClass('hangman', 'Hangman.php');


// TODO: Determine if there's a game in progress
$_SESSION['continued_game'] = "FALSE";

$game_won = false;
if (isset($_SESSION['correct'])) {
  $game_won = !(in_array("_ ", $_SESSION['correct']));
}

if ((isset($_REQUEST['action']) && $_REQUEST['action'] == 'end') || $_SESSION['numWrongGuesses'] > 7 || $game_won) {
  $new_escape = TRUE;
} else {
  $new_escape = FALSE;
}


if(isset($_SESSION['correct']) && !($new_escape) && ($_SESSION['numWrongGuesses'] < 6)) {
  // TODO: Load the previous state of the in-progress game
  $game = new Hangman($_SESSION["word"], $_SESSION['numWrongGuesses'], $_SESSION['usedLetters'], $_SESSION['correct']);
  $_SESSION['continued_game'] = "TRUE";
  //Otherwise, create a new game
} else {

  //Variables for new game

  $words = file(PHPWS_SOURCE_DIR . "mod/hangman/inc/hangwords.txt");
  $new_word =  $words[array_rand($words, 1)];

  $numWrongGuesses = 0;
  $letters = array();

  $game = new Hangman($new_word, $numWrongGuesses, $letters, "");

  $_SESSION["word"] = $game->get_word();
  $_SESSION['numWrongGuesses'] = $game->get_numWrongGuesses();
  $_SESSION['usedLetters'] = $game->get_usedLetters();
  $_SESSION['correct'] = $game->get_correct_obj();
}


// TODO: Handle the requested action (for example, choosing a letter)
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'chooseLetter') {
  $letter = $_REQUEST['letter'];
  $game->chooseLetter($_REQUEST['letter']); //TODO: Check this global variable... does it exist?

  $_SESSION['numWrongGuesses'] = $game->get_numWrongGuesses();
  $_SESSION['usedLetters'] = $game->get_usedLetters();
  // Word stays the same if the game isn't over.
  $_SESSION['word'] = $game->get_word();
  $_SESSION['correct'] = $game->get_correct_obj();

}


// Show the game by rendering it using a View
 $view = new HangView($game);
// TODO: Finish this:
\Layout::add($view->show());
