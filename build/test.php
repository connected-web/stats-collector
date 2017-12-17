<?php

$NL = "\n";

require('stats.secret.php');
require('classes/Connection.class.php');
require('classes/StatsEvent.class.php');

$connection = new Connection();
$statsEvent = new StatsEvent($connection);
$dbc = $connection->connect($STATS_CONFIG);

$tests = array();
$entryId = $statsEvent->create('{"test": true}', 'stats', 'test', 'value');
$tests[] = $entryId;
$tests[] = $statsEvent->update($entryId, '{"test": false}', 'stats', 'test', 'value');
$tests[] = $statsEvent->delete($entryId);

$results = array();
$results[] = '<div class="database results">';
$results[] = '<h2>Test Results</h2>';
$results[] = '<p>' . print_r($tests, true) . '</p>';
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
