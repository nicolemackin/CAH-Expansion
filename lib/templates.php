<?
require_once("lib/db.php");
//session_start();

$vts = $db->prepare("SELECT COUNT(*) FROM votes
WHERE cardid = ?");

function render_card($info) {

  global $vts;

  $type = $info['type'];
  $id = $info['id'];

  if($type == 0){
    $color = "black";
  }
  else{
    $color = "white";
  }

  echo('<div class="'.$color.' card">'.$info['text']);

  $vts ->execute([$id]);
  $votes = $vts->fetch()[0];


  echo('</br>'.$votes.'<button class="vote" id="vote" onclick="upvote('.$id.')"> Like </button>');

  echo('</div>');

}

function render_cards($cards) {

  foreach($cards as $card){
    render_card($card);
  }

}

?>

<script>

function upvote(cardid) {
  var req = new XMLHttpRequest();
  req.open("POST", "/votes.php", true);
  req.setRequestHeader("Content-Type", "application/json");
  req.send(JSON.stringify({cardid: cardid}));

  req.onreadystatechange = function(){
		if (req.readyState != 4)
			return;
		if (req.status != 200)
			console.log("Error!");
		console.log(req.responseText);
		var replace = document.getElementById("vote");
		replace.innerHTML = req.responseText;
	}
}

</script>
