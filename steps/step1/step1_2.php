<?php

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a log channel.
$log = new Logger('Step1Logger');
$log->pushHandler(new StreamHandler('step1.log', Logger::INFO));

// Add records to the log.
$log->addInfo(LogMessages::getMessage('hardcoded'));

class LogMessages {
  static $messages = [
    'hardcoded' => [
      'message' => 'This is a hard coded piece of text.',
      'uuid' => '783EEFAA-9E49-11E3-80F6-A1572A252E0A',
    ]
  ];

  static function getMessage($id) {
    return '(' . self::$messages[$id]['uuid'] . ') ' . self::$messages[$id]['message'];
  }
}
