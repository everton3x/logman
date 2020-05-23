<?php
require 'vendor/autoload.php';

$logman = new \LogMan\LogMan();

$logger = new \LogMan\Logger\StdOutLogger();

$logman->assignLoggerToInfoLevel($logger);

$messenger = $logman->getMessenger();

$messenger->info('Today is {today} and my name is {name}.', [
    'today' => date('Y-m-d'),
    'name' => 'Joe'
]);


$messenger->setTemplate("The logger {loggerName} say {message} at {time} on {level}\n\r");
$messenger->info('Today is {today} and my name is {name}.', [
    'today' => date('Y-m-d'),
    'name' => 'Mary'
]);
