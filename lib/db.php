<?
$db = new PDO("sqlite:/tmp/CAH-db.sqlite");
$db-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$db->exec("pragma foreign_keys=ON");