<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('Step1Logger');
$log->pushHandler(new StreamHandler('step1.log', Logger::Info));

// add records to the log
$log->addInfo('This is a long hardcoded message');
$log->addInfo('This is some ');
