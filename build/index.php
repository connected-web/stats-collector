<?php

$NL = "\n";

require('connect.inc.php');

$connection = new Connection();
$dbc = $connection->connect();

$results = array();
$results[] = '<div class="database results">';
$results[] = '<p>Database connection: ' . print_r($dbc, true) . '</p>';
$results[] = '<p>' . print_r($connection->listTables(), true) . '</p>';
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
