<?php

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$log = new Logger('Step4Logger');
$log->pushHandler(new StreamHandler(__DIR__ . '/step4.log', Logger::DEBUG));

class LogMessages {
  static $m = [
    'random-message' => [
      'message' => 'This message is output at random.',
      'uuid' => '087BF10E-9F2A-11E3-B4AB-D6A12A252E0A',
    ],
  ];

  static function getMessage($id) {
    return '(' . self::$m[$id]['uuid'] . ') ' . self::$m[$id]['message'];
  }
}
 
$request = Request::createFromGlobals();
 
$response = new Response('Hello DrupalCamp London! :D' . PHP_EOL);
 
$response->send();
 
