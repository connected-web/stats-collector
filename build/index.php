<?php

$NL = "\n";

require('stats.secret.php');
require('classes/Connection.class.php');
require('classes/StatsEvent.class.php');

function pp($val) {
  return json_encode($val, JSON_PRETTY_PRINT);
}

$connection = new Connection();
$statsEvent = new StatsEvent($connection);
$dbc = $connection->connect($STATS_CONFIG);

$tables = $connection->listTables();
$events = $statsEvent->read();

$results = array();
$results[] = '<div class="database results">';
$results[] = '<p>Database connection: ' . $dbc['result'] . '</p>';
$results[] = '<p><pre>' . pp($tables) . '</pre></p>';
$results[] = '<p><pre>' . pp($events) . '</pre></p>';
$results[] = '</div>';

ob_start();
require('./index.template.html');
$template = ob_get_clean();

$body = $template;
$body = str_replace('{{DATABASE}}', $STATS['mysql_database'], $body);
$body = str_replace('{{RESULTS}}', join($results, $NL), $body);

header('x-stats: online');
echo $body;
echo "<!-- X-Stats: Online -->";
