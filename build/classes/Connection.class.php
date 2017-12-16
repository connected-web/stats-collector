<?php

class Connection {

  private $connection = false;

  public function connect($config) {
    $hostname = $config['mysql_hostname'];
    $database = $config['mysql_database'];
    $username = $config['mysql_username'];
    $password = $config['mysql_password'];

    try {
      $this->connection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      // set the PDO error mode to exception
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = "Connected successfully";
    }
    catch(PDOException $e) {
      $result = "Connection failed: " . $e->getMessage();
    }

    return Array(
      "result" => $result,
      "connection" => $this->connection
    );
  }

  public function query($sql) {
    return $this->connection->query($sql);
  }

  public function listTables() {
    $sql = 'SHOW TABLES';
    $query = $this->connection->query($sql);

    return $query->fetchAll(PDO::FETCH_COLUMN);
  }

}
