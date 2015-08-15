<?
  require("lib/header.php");
  require_once("lib/db.php");
  require_once("lib/templates.php");
?>

<script>
  function SelectElement(valueToSelect)
  {
      var element = document.getElementById('color');
      element.value = valueToSelect;
  }
  function colorChange(){
    var clr = document.getElementById("browse");
    clr.submit();
  }

  function sortChange(){
    var sort = document.getElementById("browse");
    sort.submit();
  }
</script>

<?
$slctclr = $_GET['color'];
if($slctclr==="black") {
  $slctblk = "selected";
  $slctwht = "";
  $slctall = "";

  $clr = 0;
}
elseif($slctclr==="white") {
  $slctwht = "selected";
  $slctblk = "";
  $slctall = "";

  $clr = 1;
}
else {
  $slctwht = "";
  $slctblk = "";
  $slctall = "selected";

  $clr = "all";
}

$slctsrt = $_GET['sort'];

if($slctsrt==="leastpop") {
  $slctmpop = "";
  $slctlpop = "selected";
  $slctnew = "";
}
else if($slctsrt==="new") {
  $slctmpop = "";
  $slctlpop = "";
  $slctnew = "selected";
}
else{
  $slctmpop = "selected";
  $slctlpop = "";
  $slctnew = "";
}
?>


<form id="browse" method="GET">
  <select id="color" name="color" onchange="colorChange()">
    <option value="all" <?= $slctall?>>All</option>
    <option value="black"<?= $slctblk?>>Black</option>
    <option value="white" <?= $slctwht?>>White</option>
  </select>
  <select id="sort" name="sort" onchange="sortChange()">
    <option value="mostpop"<?= $slctmpop?>>Most Popular</option>
    <option value="leastpop"<?= $slctlpop?>>Least Popular</option>
    <option value="new"<?= $slctnew?>>New</option>
  </select>
</form>
<?
$sql = "SELECT type, text, id FROM cards";
$var = array();
if($clr !== "all")
{
  $var[] = $clr;
  $sql.=" WHERE type = ?";
}

$browse = $db->prepare($sql);
$browse->execute($var);

#render cards
$row = $browse->fetchAll();
render_cards($row);
?>
