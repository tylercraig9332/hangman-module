<?php


class HangView {

    public function __construct(Hangman $game)
    {
        // TODO: save a reference to the game in a member variable
        $this->game = $game;
        $this->used = $game->get_usedLetters();
        $this->guess = $game->get_numWrongGuesses();
        $this->word = $game->get_word();
        $this->data = $game->get_data();
    }

    public function show()
    {
      $template = array('TITLE' => 'Hangman');
      $template['CONTENT_HEADER'] = "Hangman Game";
      $template['WORD'] = $this->word;
      $template['DATA'] = $this->data . " USED: ";
      $template['CORRECT'] = $this->game->get_correct();


      $img = "hang" . $this->guess . ".gif";
      $template['IMG_SRC'] = "img/$img";



        $alphas = range('A', 'Z');
        $unused = array();
        // If we have used letters than we will subtract them from the list.
        if ($this->used != null) {
          foreach ($this->used as &$letter){
            $key = array_search($letter, $alphas);
            if ($key!==false){
              unset($alphas[$key]);
            }
            $template['DATA'] .= "$letter";
            unset($key);
          }
          unset($letter);
        }
        //Otherwise, we will adjust for the template.
        foreach ($alphas as &$letr) {
          $unused[] = array('LETTER' => $letr);
        }

        $template['UNUSED_LETTERS'] = $unused;

        $temp_bool = in_array("_ ", $this->game->get_correct_obj());
        if (!$temp_bool && $this->guess >= 0){
          $template['CORRECT'] .= ": Congrats, you won!";
          $template['UNUSED_LETTERS'] = null;
        }
        if ($this->guess == 6) {
           $template['CORRECT'] = $template['WORD'] . ": Better luck next time... :(";
           $template["IMG_SRC"] = "img/hang6.gif";
           $template['UNUSED_LETTERS'] = null;
        }

        // TODO return HTML from PHPWS_Template::process(...)
        // Template is in templates/hangmangame.tpl
        //$template_loc = PHPWS_SOURCE_DIR . "mod/hangman/templates/hangmangame.tpl";
        $template_loc = "hangmangame.tpl";
        $module = "hangman";
        $html = PHPWS_Template::process($template, $module, $template_loc);
        \Layout::add($html);

        // Delete when done with template:
        //\Layout::add("<a href=\"index.php?module=hangman&action=chooseLetter&letter=B\">click me to continue the game</a><br>");
        //\Layout::add("<a href=\"index.php?module=hangman&action=end\">click me to restart the game</a>");
    }
}
