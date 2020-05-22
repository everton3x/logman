<?php
namespace LogMan\Messenger;

use LogMan\LogMan;

/**
 * Interface para mensageiros.
 * 
 * Um mensageiro é uma classe que envia mensagens para um ou mais loggers.
 * 
 * @author Everton
 */
interface MessengerInterface
{

    public function __construct(LogMan $logman);

    public function emergency($message, array $context = []);

    public function alert($message, array $context = []);

    public function critical($message, array $context = []);

    public function error($message, array $context = []);

    public function warning($message, array $context = []);

    public function notice($message, array $context = []);

    public function info($message, array $context = []);

    public function debug($message, array $context = []);
}
