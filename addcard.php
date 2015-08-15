<?php
require_once("lib/db.php");

#checking Color value
if (!is_numeric($_POST['clr'])){
  echo("Error: 'Choose colour' is not a valid colour. <a href='/'>Okay...</a>");

  exit(400);
}
#formats color value
$clr = +$_POST['clr']; #colour value

if ($clr!==0&&$clr!==1){
  echo("Somewhere, somehow, you fucked up.  <a href='/'>Okay...</a>");

  exit(400);
}

#checking text field
$txt = $_POST['txt'];

if (!$txt){
  echo("Error: You cannot submit a blank card.  <a href='/'>Okay...</a>");

  exit(400);
}
else if(strlen($txt) > 80){
  echo("You can't have more than 80 characters.  <a href='/'>Okay...</a>");

  exit(400);
}

$save = $db->prepare("
    INSERT INTO cards (type,text)
    VALUES (?,?);
    ");
$save->execute([$clr,$txt]);

header("Location: /");
die();
