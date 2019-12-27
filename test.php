
<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

echo "data:" . date('r');
flush();



$time = $_GET['token'];

echo "data: The server time is: {$time}\n\n";
flush();
