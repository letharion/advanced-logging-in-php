<?php

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Create a log channel.
$log = new Logger('Step1Logger');
$log->pushHandler(new StreamHandler('step1.log', Logger::INFO));

// Add records to the log.
$log->addInfo('This is a hardcoded piece of text.');
