<?php

class StatsEvent {

  private $connection = false;

  public function __construct($connection) {
    $this->connection = $connection;
  }

  public function read() {
    $sql = 'SELECT * FROM events';
    $events = $this->connection->query($sql)->fetchAll(PDO::FETCH_NAMED);
    foreach ($events as &$event) {
      $event['context'] = json_decode($event['context']);
    }
    return $events;
  }

  public function create($context, $site, $name, $type) {
    $sql = "INSERT INTO `events` (`id`, `context`, `datetime`, `site`, `name`, `type`) VALUES (NULL, :context, now(), :site, :name, :type)";
    $params = Array(
      ":context" => $context,
      ":site" => $site,
      ":name" => $name,
      ":type" => $type
    );
    $this->connection->query($sql, $params);
    return $this->connection->lastInsertId();
  }

  public function update($id, $context, $site, $name, $type) {
    $sql = "UPDATE `events` SET `context` = :context, `site` = :site, `name` = :name, `type` = :type WHERE `events`.`id` = :id LIMIT 1";
    $params = Array(
      ":id" => $id,
      ":context" => $context,
      ":site" => $site,
      ":name" => $name,
      ":type" => $type
    );
    return $this->connection->query($sql, $params);
  }

  public function delete($id) {
    $sql = "DELETE FROM `events` WHERE `id`=:id LIMIT 1";
    $params = Array(
      ":id" => $id
    );
    return $this->connection->query($sql, $params);
  }
}
