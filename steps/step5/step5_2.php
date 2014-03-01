<?php

require __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;

$log = new Logger('Step5Logger');
$log->pushHandler(new StreamHandler(__DIR__ . '/step5.log', Logger::DEBUG));

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
  ];

  static function getMessage($id) {
    return '(' . self::$h . ') (' . self::$m[$id]['uuid'] . ') ' . self::$m[$id]['message'];
  }
}

$request = Request::createFromGlobals();
LogMessages::$h = substr(hash('sha512', serialize($request) . microtime()), 0, 10);

// Initialize an application aspect container
$applicationAspectKernel = ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(array(
  'debug' => true, // use 'false' for production mode
  // Cache directory
  'cacheDir'  => __DIR__ . '/path/to/cache/for/aop',
  // Include paths restricts the directories where aspects should be applied, or empty for all source files
  'includePaths' => array(
    __DIR__ . '/../src/'
  )
));

function generate_output($log, $request) {
  $log->addDebug(LogMessages::getMessage('app-start'));

  $response = new Response('Hello DrupalCamp London! :D' . PHP_EOL);

  $response->send();

  $log->addDebug(LogMessages::getMessage('app-exit'));
}

generate_output($log, $request);
