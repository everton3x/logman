<?php
require 'vendor/autoload.php';

$logman = new \LogMan\LogMan();

$logger1 = new \LogMan\Logger\StdOutLogger();
$logger1->setLoggerName('José');
$logger2 = new \LogMan\Logger\StdOutLogger();
$logger2->setLoggerName('Maria');

$logman->assignLoggerToInfoLevel($logger1, $logger2);
$logman->assignLoggerToNoticeLevel($logger2);
$logman->assignLoggerToDebugLevel($logger1);

$messenger = $logman->getMessenger();

$messenger->info('José e Maria');
$logman->toggleDebug(true);
$messenger->debug('Apenas José');
$logman->toggleNotice(false);
$messenger->notice('Apenas Maria');
