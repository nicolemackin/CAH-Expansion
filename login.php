<?php
  require_once("lib/OpenIDConnectHelper.php");

  $oidcc->addScope('email');
  $oidcc->setRedirectURL("http://$_SERVER[HTTP_HOST]/OpenIDCallback.php");
	$oidcc->authenticate();
?>
