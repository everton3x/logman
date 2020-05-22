<?php
namespace LogMan\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Logger para a saída padrão.
 *
 * @author Everton
 */
class StdOutLogger implements LoggerInterface
{

    protected string $loggerName = 'unamed';

    public function __construct()
    {
        
    }

    public function setLoggerName(string $name)
    {
        $this->loggerName = $name;
    }

    public function getLoggerName(): string
    {
        return $this->loggerName;
    }

    public function alert($message, array $context = array()): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = array()): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function debug($message, array $context = array()): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function emergency($message, array $context = array()): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function error($message, array $context = array()): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function info($message, array $context = array()): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function log($level, $message, array $context = array()): void
    {
        $messageFormatted = str_pad("[ $level ]", 20, ' ', STR_PAD_RIGHT) . $message . PHP_EOL;
        $messageFormatted = "Looger {$this->getLoggerName()} diz: $messageFormatted"; //@test
        fwrite(STDOUT, $messageFormatted);
    }

    public function notice($message, array $context = array()): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function warning($message, array $context = array()): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }
}
