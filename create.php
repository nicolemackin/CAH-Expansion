<?php
require_once("lib/db.php");
$db->exec("
  CREATE TABLE IF NOT EXISTS cards
  (
    id INTEGER PRIMARY KEY NOT NULL,

    -- 0 is black, 1 is white
    type BOOLEAN NOT NULL,

    --text field of card
    text TEXT
  );

  CREATE TABLE IF NOT EXISTS votes
  (
    userid INTEGER NOT NULL,

    cardid INTEGER NOT NULL,

    PRIMARY KEY (userid, cardid)
  );

  CREATE TABLE IF NOT EXISTS users
  (
    id INTEGER PRIMARY KEY NOT NULL,

    name TEXT,

    email TEXT
  );

  CREATE TABLE IF NOT EXISTS openidconnect
  (
    userid INTEGER NOT NULL REFERENCES users(id),

    realm TEXT,

    id TEXT
  );
");

?>
