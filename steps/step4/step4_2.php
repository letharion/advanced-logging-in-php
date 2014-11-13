<?php

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Letharion\Logging\OpportunisticLogger;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$messages = [
  'app-start' => [
    'uuid' => '98104AC4-9FEB-11E3-B42B-FEE227518C08',
    'message' => 'Application starting.',
  ],
  'app-exit' => [
    'uuid' => 'AC5B6C02-9FEB-11E3-BE1E-FEE227518C08',
    'message' => 'Application exiting.',
  ],
  'app-blew-up' => [
    'uuid' => 'E4BBD7E4-A158-11E3-B01B-924574EB0A54',
    'message' => 'Application blew up! :(',
  ]
];

$handler = new StreamHandler('step4.log', Logger::INFO);
$log = new OpportunisticLogger('Step4Logger', $messages, $handler);

$request = Request::createFromGlobals();

$log->debug('app-start');

$input = $argv[1];
if ($input === 'World') {
  $log->warning('app-blew-up');
}

$response = new Response(sprintf('Hello %s at DrupalCamp London :D', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')) . PHP_EOL);

$response->send();

$log->debug('app-exit');
