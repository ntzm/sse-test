<?php

header('Content-Type: text/event-stream');

$counter = mt_rand(1, 10);

while (1) {
    $now = date(DATE_ATOM);

    echo "event: ping\n",
        'data: ' . json_encode(['time' => $now]),
        "\n\n";

    $counter--;

    if ($counter === 0) {
        echo 'data: This is a message at time ' . $now, "\n\n";
        $counter = mt_rand(1, 10);
    }

    while (ob_get_level() > 0) {
        ob_end_flush();
    }
    flush();

    if (connection_aborted() === 1) {
        break;
    }

    sleep(1);
}
