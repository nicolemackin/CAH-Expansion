<?
require_once("lib/db.php");
session_start();
$name = $_SESSION['login_name'];
$email = $_SESSION['login_email'];
$id = $_SESSION['login_user'];
$provider = $_SESSION['login_realm'];

$saveuser = $db->prepare("
    INSERT INTO users (name,email)
    VALUES (?,?);
    ");
$saveuser->execute([$name,$email]);

$userid = $db->lastInsertId();

$saveid = $db->prepare("
    INSERT INTO openidconnect (userid,realm,id)
    VALUES (?,?,?);
    ");
$saveid->execute([$userid,$provider,$id]);

$_SESSION['userid'] = $userid;

header("Location:/");
?>
