<?php

require __DIR__ . '/vendor/autoload.php';

$guzzle = new GuzzleHttp\Client();

$response = $guzzle->request('GET', 'http://localhost:8000/sse.php', [
    'stream' => true,
]);

$body = $response->getBody();

while ($body->eof() === false) {
    echo $body->read(1024);
}
