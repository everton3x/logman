<?php
namespace LogMan\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Logger for standard output as defined in PHP's STDOUT.
 *
 * @author Everton da Rosa
 * @link https://www.php.net/manual/en/features.commandline.io-streams.php I/O Streams on PHP.
 */
class StdOutLogger implements LoggerInterface
{

    /**
     *
     * @var string The name of the logger.
     */
    protected string $loggerName = 'unamed';

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * 
     * @param string $name
     * @see LoggerInterface
     */
    public function setLoggerName(string $name)
    {
        $this->loggerName = $name;
    }

    /**
     * 
     * @return string
     * @see LoggerInterface
     */
    public function getLoggerName(): string
    {
        return $this->loggerName;
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::alert()
     */
    public function alert($message, array $context = array()): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::critical()
     */
    public function critical($message, array $context = array()): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::debug()
     */
    public function debug($message, array $context = array()): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::emergency()
     */
    public function emergency($message, array $context = array()): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::error()
     */
    public function error($message, array $context = array()): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::info()
     */
    public function info($message, array $context = array()): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * 
     * @param type $level
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::log()
     */
    public function log($level, $message, array $context = array()): void
    {
        $messageFormatted = str_pad("[ $level ]", 20, ' ', STR_PAD_RIGHT) . $message . PHP_EOL;
        fwrite(STDOUT, $messageFormatted);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::notice()
     */
    public function notice($message, array $context = array()): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @return void
     * @see LoggerInterface::warning()
     */
    public function warning($message, array $context = array()): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }
}
