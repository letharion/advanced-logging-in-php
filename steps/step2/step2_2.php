<?php

require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Letharion\Logging\OpportunisticLogger;

$messages = [
  'event-starts' => [
    'uuid' => 'ECE7B7BA-9E53-11E3-A432-D70C28518C08',
    'message' => 'Event @event is about to start.',
  ]
];

// Create a log channel.
$handler = new StreamHandler('step2.log', NULL, LOGGER::INFO);
$log = new OpportunisticLogger('Step2Logger', $messages, $handler);

// Add records to the log.
$log->info('event-starts', ['@event' => 'Concert']);
$log->info('event-starts', ['@event' => 'TV']);
$log->info('event-starts', ['@event' => 'Radio']);
