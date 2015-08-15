<?
require_once("lib/db.php");
require_once("lib/OpenIDConnectHelper.php");
require_once("create.php");


$oidcc->authenticate();

$provider = $oidcc->getProviderURL();
$uid = $oidcc->requestUserInfo('sub');
$email = $oidcc->requestUserInfo('email');
$name = $oidcc->requestUserInfo('name');

$info = $db->prepare("
SELECT userid FROM openidconnect
WHERE realm = ?
AND id = ?
");

$var = array($provider,$uid);

$info->execute($var);
$rows = $info->fetchAll();

if ($rows)
{
  header("Location:/");
}
else{
?>
</br> No account by this name, would you like to create one?

</br>
<form action="newaccount.php">
  <button type="submit">Yes</button>
</form>
<form action="index.php">
  <button type="submit">no</button>
</form>


<?
} //ends else statement

session_start();
$_SESSION['login_name']= $name;
$_SESSION['login_email']= $email;
$_SESSION['login_user']= $uid;
$_SESSION['login_realm']= $provider;
?>
