<?php

class StatsEvent {

  private $connection = false;

  public function __construct($connection) {
    $this->connection = $connection;
  }

  public function read() {
    $sql = 'SELECT * FROM events';
    $query = $this->connection->query($sql);

    return $query->fetchAll();
  }

  public function create() {
    return Array(
      "message" => 'Create not implemented'
    );
  }

  public function update() {
    return Array(
      "message" => 'Update not implemented'
    );
  }

  public function delete() {
    return Array(
      "message" => 'Delete not implemented'
    );
  }
}
