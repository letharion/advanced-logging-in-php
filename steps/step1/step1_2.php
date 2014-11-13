<?php

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Letharion\Logging\OpportunisticLogger;

$messages = [
  'hardcoded' => [
    'uuid' => '783EEFAA-9E49-11E3-80F6-A1572A252E0A',
    'message' => 'This is a hard coded piece of text.',
  ]
];

$handler = new StreamHandler('step1.log', NULL, LOGGER::INFO);
$log = new OpportunisticLogger('Step1Logger', $messages);// , $handler);

// Add records to the log.
$log->info('hardcoded');
