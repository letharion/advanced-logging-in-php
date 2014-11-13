<?php

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Letharion\Logging\OpportunisticLogger;

$messages = [
  'random-message' => [
    'uuid' => '087BF10E-9F2A-11E3-B4AB-D6A12A252E0A',
    'message' => 'This message is output at random.',
  ],
];

$handler = new StreamHandler('step3.log', NULL, Logger::INFO);
$log = new OpportunisticLogger('Step3Logger', $messages, $handler);

$request = Request::createFromGlobals();

while(0 != rand(0, 2)) {
  $log->info('random-message');
}

$response = new Response('Hello DrupalCamp London! :D' . PHP_EOL);
 
$response->send();
