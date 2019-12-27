
<?php
function setInterval($f, $milliseconds)
{
    $seconds = (int) $milliseconds / 1000;
    $i = 0;
    while ($i < 5) {
        $f();
        $i++;
        sleep($seconds);
    }
}

header('Content-Type: text/event-stream');
header('Connection: keep-alive');
header('Cache-Control: no-cache');

$time = $_GET['token'];

setInterval(function () {
    ob_clean();
    echo "data: The server time is:" . date('r') . "\n\n";
    ob_flush();
    flush();
}, 1000);
