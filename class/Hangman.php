<?php

class Hangman {

    private $word;
    private $numWrongGuesses;
    private $usedLetters;

    public function __construct($word, $numWrongGuesses, $usedLetter, $correct){
        // save params in member variables
        $this->word = $word;
        $this->numWrongGuesses = $numWrongGuesses;
        $this->usedLetters = $usedLetter;
        //To make my life easy
        if ($correct == "") {
          $this->correct = array();
          for ($i = 0; $i < strlen($this->word) - 1; $i++) {
            array_push($this->correct, "_ ");
          }
        } else {
          $this->correct = $correct;
        }
        // Used so I can debug. Like a toString()
        $this->data = "";
    }

    public function chooseLetter($letter)
    {
        // check if the letter is in the word

        $str_arr = str_split($this->get_word());

        $temp_bool = FALSE;
        $position = 0;
        foreach ($str_arr as &$letr){
          // Check so that an action won't be counted twice.
          if (in_array(strtolower($letter), $this->usedLetters)) {
            $temp_bool = FALSE;
            break;
          }
          // Looks to see if the letter is in the word.
          if (strtolower($letr) == strtolower($letter)){
            $temp_bool = TRUE;
            $this->correct[$position] = $letr;
          }
          $position++;
        }
        unset($letr);

        // If not, increment num wrong guesses
        if (!($temp_bool)){
          ++$this->numWrongGuesses;
        }
        else {

        }
        //Not sure if neccesary?
        unset($temp_bool);
        // Always add the letter to $usedLetters array
        if ($this->usedLetters == null)
        {
          $this->usedLetters = array($letter);
        } else {
          array_push($this->usedLetters, $letter);
        }
    }

    // Getter/setter methods

    function get_word(){
      return $this->word;
    }

    function set_word($new_word){
      $this->word = $new_word;
    }

    function get_numWrongGuesses(){
      return $this->numWrongGuesses;
    }


    function set_numWrongGuesses($new_num){
      $this->numWrongGuesses = $new_num;
    }

    function get_usedLetters(){
      return $this->usedLetters;
    }

    //Also can be considered a setter.
    function set_usedLetters($new_letters){
      $this->usedLetters = $new_letters;
    }

    function get_correct_obj() {
      return $this->correct;
    }

    function get_correct(){
      $str = "";
      foreach ($this->correct as $letter){
        $str .= $letter;
      }
      return $str;
    }

    //Used to help me debug
    function get_data(){
      return $this->data;
    }

}
