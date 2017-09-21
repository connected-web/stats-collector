<?php

require('stats.secret.php');

function connect() {
  global $STATS;
  $hostname = $STATS['mysql_hostname'];
  $database = $STATS['mysql_database'];
  $username = $STATS['mysql_username'];
  $password = $STATS['mysql_password'];

  try {
    $connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result = "Connected successfully";
  }
  catch(PDOException $e) {
    $result = "Connection failed: " . $e->getMessage();
  }

  return Array(
    "result" => $result,
    "connection" => $connection
  );
}

function listTables($connection) {
  $sql = 'SHOW TABLES';
  $query = $connection->query($sql);

  return $query->fetchAll(PDO::FETCH_COLUMN);
}
