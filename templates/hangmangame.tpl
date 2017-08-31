<title>{CONTENT_HEADER}</title>

<style>
  a {text-decoration: none;}
</style>

<div class="container">
  <h1>This is {TITLE}</h1>
  <br>
  <img src=mod/hangman/{IMG_SRC}> <h2>{CORRECT}</h2>
  <br>
</div>


<div class="btn-group" role="group" aria-label="...">
  <!-- BEGIN UNUSED_LETTERS -->
  <a href="index.php?module=hangman&action=chooseLetter&letter={LETTER}">
    <button type="button" class="btn btn-default">{LETTER} </button>
  </a>
  <!-- END UNUSED_LETTERS -->
  <br>
</div>


<a href="index.php?module=hangman&action=end">
  <button type="button" class="btn btn-default">New Game</button>
</a>
<p>{DATA}<p>
