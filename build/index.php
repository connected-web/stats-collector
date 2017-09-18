<?php

require('stats.secret.php');

ob_start();
require('./index.template.html');
$body = ob_get_clean();

$body = str_replace('{{DATABASE}}', $STATS['mysql_database'], $body);

header('x-stats: online');
echo $body;
echo "<!-- X-Stats: Online -->";
