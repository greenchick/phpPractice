<?php
require_once('config.php');

function connectionDb() {
  try{
    return new PDO(DSN,DB_USER,DB_PASSORD);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}