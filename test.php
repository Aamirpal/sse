
<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = $_GET['token'];
while (true) {
    ob_clean();
    echo "data: The server time is: {$time}\n\n";
    sleep(1000);
    flush();
}
