<?php

if (!defined('PHPWS_SOURCE_DIR')) {
    include '../../core/conf/404.html';
    exit();
}


\phpws\PHPWS_Core::initModClass('hangman', 'Hangman.php');


// TODO: Determine if there's a game in progress

// TODO: Load the previous state of the in-progress game

// TODO: Otherwise, create a new game


// TODO: Handle the requested action (for example, choosing a letter)
//if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'chooseLetter') {...}


// TODO: Show the game by rendering it using a View
// $view = new HangView($game);
// \Layout::add($view->show());

\Layout::add('This is hangman.');
