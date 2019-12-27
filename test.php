
<?php
function setInterval($f, $milliseconds)
{
    $seconds = (int) $milliseconds / 1000;
    while (true) {
        $f();
        sleep($seconds);
    }
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = $_GET['token'];

setInterval(function () {
    ob_clean();
    echo "data: The server time is: {$time}\n\n";
    flush();
}, 1000);
