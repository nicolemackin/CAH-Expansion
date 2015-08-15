<?
  require("lib/header.php");
  require_once("lib/db.php");
  require_once("lib/templates.php");
?>

<h3>C-Eng Cards Against Humanity Expansion Set </h3>


<h4> Create a Card </h4>
<p>Please note that once a card is submitted it cannot be changed, so please make you have read <a href="#rules">the rules</a> before submitting anything!
</p>

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


<h4>The Project</h4>
<p>This project should allow for a full printable expansion based around Carleton Engineering. A great expansion for game nights of all streams! The project allows students to submit relevent content and upvote those they like most. To sign up, email us your SIN # and banking information, or follow the links in the header by signing in with your Google Account.</p>

<h4>The Look</h4>

<!-- Card selection code-->
<?

  $res = $db->query("
    SELECT * FROM cards WHERE type = 0
    LIMIT 1;
  ");
  $row = $res->fetch();
  render_card($row);
?>
<br/>
<?
  $res = $db->query("
    SELECT * FROM cards WHERE type = 1
    LIMIT 3;
  ");
  $row = $res->fetchAll();
  render_cards($row);
?>

<!-- The card creation code -->
<a name="rules"><h4> Da Rules </h4></a>
<ul>
  <li>Read the rules</li>
  <li>Don't be a DINK</li>
  <li>Don't submit content about others without their permission. I will hunt them down and ask them</li>
  <li>Don't make multiple accounts to upvote your own cards</li>
  <li>Report things that make you uncomfortable so I can manage the content and provide a better experience to all </li>
  <li>Checked to make sure a similar card has not already been submitted</li>
  <li>Make sure all content is spelled correctly (or as intended) before submission!</li>
</ul>

<?
require("lib/footer.php");
?>
