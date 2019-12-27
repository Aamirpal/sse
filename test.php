
<?php
@set_time_limit(0); // Disable time limit
// Prevent buffering
if (function_exists('apache_setenv')) {
    @apache_setenv('no-gzip', 1);
}
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
while (ob_get_level() != 0) {
    ob_end_flush();
}
ob_implicit_flush(1);
ini_set('auto_detect_line_endings', 1);
ini_set('max_execution_time', '0');

/* start fresh */
ob_end_clean();

/* ultility function for sending SSE messages */
function sse($evtname = 'sse', $data = null, $retry = 1000)
{
    if (!is_null($data)) {
        echo "event:" . $evtname . "\r\n";
        echo "retry:" . $retry . "\r\n";
        echo "data:" . json_encode($data, JSON_FORCE_OBJECT | JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
        echo "\r\n\r\n";
    }
}

$id = 0;
$event = 'event1';
$oldValue = null;

header("HTTP/1.1 200 OK");
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('X-Accel-Buffering: no');
header('Transfer-encoding: chunked');

$counter = rand(1, 10);
while (true) {
    // Every second, send a "ping" event.

    echo "event: ping\n";
    $curDate = date(DATE_ISO8601);
    echo 'data: {"time": "' . $curDate . '"}';
    echo "\n\n";

    // Send a simple message at random intervals.

    $counter--;

    if (!$counter) {
        echo 'data: This is a message at time ' . $curDate . "\n\n";
        $counter = rand(1, 10);
    }

    ob_end_flush();
    flush();
    sleep(1);
}
