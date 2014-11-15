<?php

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FingersCrossedHandler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$fxlog = new Logger('Step4FXLogger');
$fxlog->pushHandler(new FingersCrossedHandler(new StreamHandler(__DIR__ . '/step4.log', Logger::DEBUG)));

class LogMessages {
  static $h = '';

  static $m = [
    'app-start' => [
      'message' => 'Application starting.',
      'uuid' => '98104AC4-9FEB-11E3-B42B-FEE227518C08',
    ],
    'app-exit' => [
      'message' => 'Application exiting.',
      'uuid' => 'AC5B6C02-9FEB-11E3-BE1E-FEE227518C08',
    ],
    'app-blew-up' => [
      'message' => 'Application blew up! :(',
      'uuid' => 'E4BBD7E4-A158-11E3-B01B-924574EB0A54',
    ]
  ];

  static function getMessage($id) {
    return '(' . self::$h . ') (' . self::$m[$id]['uuid'] . ') ' . self::$m[$id]['message'];
  }
}

$request = Request::createFromGlobals();

LogMessages::$h = substr(hash('sha512', serialize($request) . microtime()), 0, 10);

$fxlog->addDebug(LogMessages::getMessage('app-start'));

$input = $argv[1];
if ($input === 'World') {
  $fxlog->addWarning(LogMessages::getMessage('app-blew-up'));
}

$response = new Response(sprintf('Hello %s at DrupalCamp Göteborg :D', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')) . PHP_EOL);

$response->send();

$fxlog->addDebug(LogMessages::getMessage('app-exit'));
