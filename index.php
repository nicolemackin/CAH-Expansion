<?php
  require("lib/header.php");
  require_once("lib/db.php");
  require_once("lib/templates.php");
?>

<h3>C-Eng Cards Against Humanity Expansion Set </h3>

<h4>How To</h4>
<ul>
  <li> Read <a href="#rules"> Da Rules</a> </li>
  <li><a href="login.php">Login/Create an Account</a></li>
  <li>Browse cards and vote for your favourites</li>
  <li>Make cards referencing popular events of C-Eng history</li>
  <li>Print off cards and add them to your game!</li>
</ul>
</p>

<h4> Create a Card </h4>
<p>Please note that once a card is submitted it cannot be changed, so please make you have read <a href="#rules">the rules</a> before submitting anything!
</p>

<!-- The card creation code -->
<form method="POST" action="addcard.php">

<script>
  function clrChange(){
    var clr = document.getElementById("clr");

    document.getElementById("txt");

    if(clr.value == "0") {
      txt.className = "black card"
    }
    if(clr.value == "1") {
      txt.className = "white card"
    }
  }
</script>

  Color:
  <select id="clr" name="clr" onchange="clrChange()">
    <option value="">Select colour</option>
      <option value="0">Black</option>
      <option value="1">White</option>
  </select>
  <br/>
  <textarea id="txt" name="txt" class="card" placeholder="Card text here"></textarea>
  <br/>

  <button type="submit">Submit</button>
</form>

<h4>The Look</h4>

<!-- Card selection code-->
<?php

  $res = $db->query("
    SELECT * FROM cards WHERE type = 0
    LIMIT 3;
  ");
  $row = $res->fetch();
  render_card($row);
?>
<br/>
<?php
  $res = $db->query("
    SELECT * FROM cards WHERE type = 1
    LIMIT 3;
  ");
  $row = $res->fetchAll();
  render_cards($row);
?>

<a name="rules"><h4> Da Rules </h4></a>
<ul>
  <li>Read the rules</li>
  <li>Don't be a DINK</li>
  <li>Don't submit content about others without their permission</li>
  <li>Don't make multiple accounts to upvote your own cards</li>
  <li>Report things that make you uncomfortable at <a href="mailto:nicole.mackin@carleton.ca?subject=C-ENGAH%20Problems">here</a></li>
  <li>Checked to make sure a similar card has not already been submitted</li>
  <li>Make sure all content is spelled correctly (or as intended) before submission!</li>
</ul>

<?php
require("lib/footer.php");
?>
