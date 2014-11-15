<?php

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a log channel.
$log = new Logger('Step2Logger');
$log->pushHandler(new StreamHandler('step2.log', Logger::INFO));

// Add records to the log.
$log->addInfo(LogMessages::getMessage('event-concert'));
$log->addInfo(LogMessages::getMessage('event-tv'));
$log->addInfo(LogMessages::getMessage('event-radio'));

class LogMessages {
  static $m = [
    'event-concert' => [
      'message' => 'Event "Concert" is about to start.',
      'uuid' => '6A85F30E-9E53-11E3-88A6-A1572A252E0A',
    ],
    'event-tv' => [
      'message' => 'Event "TV" is about to start.',
      'uuid' => '7EC4AEC8-9E53-11E3-8D41-A1572A252E0A',
    ],
    'event-radio' => [
      'message' => 'Event "Radio" is about to start.',
      'uuid' => '8592B510-9E53-11E3-BE86-A1572A252E0A',
    ],
  ];

  static function getMessage($id) {
    return '(' . self::$m[$id]['uuid'] . ') ' . self::$m[$id]['message'];
  }
}
