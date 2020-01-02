<?php

session_write_close();
@set_time_limit(0); // Disable time limit
// Prevent buffering
if (function_exists('apache_setenv')) {
    @apache_setenv('no-gzip', 1);
}
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
// while (ob_get_level() != 0) {
//     ob_end_flush();
// }
ob_implicit_flush(1);

/* ultility function for sending SSE messages */

header('Content-Type: text/event-stream, charset=UTF-8');
header('Cache-Control: no-cache,  must-revalidate');
//header('Transfer-encoding: chunked');
header('X-Accel-Buffering: no');
header('Connection: keep-alive');
 while (ob_get_level()) ob_end_clean();
$counter = 1;
while (1) {
    // Every second, send a "ping" event.
     
    flush();
    ob_flush();
    ob_get_contents();
    $curDate = date("r h:i:sa");
    print("id: {$counter}\n");
    //print("event: ping\n");
    print("data: The server time is: {$curDate}{$counter}\n\n");

    //print('data: "time": "' . $curDate . '"');
    //  print("\n\n");
   
    // Send a simple message at random intervals.
    
    flush();
    ob_flush();
    usleep(1000000);

    $counter++;
}
