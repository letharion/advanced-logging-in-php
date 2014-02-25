<?php

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a log channel.
$log = new Logger('Step1Logger');
$log->pushHandler(new StreamHandler('step1.log', Logger::INFO));

// Add records to the log.
$log->addInfo(LogMessages::getMessage('event'), ['@event' => 'Concert']);
$log->addInfo(LogMessages::getMessage('event'), ['@event' => 'TV']);
$log->addInfo(LogMessages::getMessage('event'), ['@event' => 'Radio']);

class LogMessages {
  static $messages = [
    'event' => [
      'message' => 'Event @event is about to start.',
      'uuid' => 'ECE7B7BA-9E53-11E3-A432-D70C28518C08',
    ],
  ];

  static function getMessage($id) {
    return '(' . self::$messages[$id]['uuid'] . ') ' . self::$messages[$id]['message'];
  }
}
