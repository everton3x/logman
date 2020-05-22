<?php
namespace LogMan\Messenger;

use LogMan\LogMan;
use LogMan\Messenger\MessengerInterface;
use Psr\Log\LogLevel;

/**
 * Default messenger
 *
 * @author Everton
 */
class DefaultMessenger implements MessengerInterface
{

    protected LogMan $logman;

    public function __construct(LogMan $logman)
    {
        $this->logman = $logman;
    }

    public function emergency($message, array $context = [])
    {
        $this->sendMessage(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->sendMessage(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->sendMessage(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->sendMessage(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->sendMessage(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->sendMessage(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->sendMessage(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->sendMessage(LogLevel::DEBUG, $message, $context);
    }

    protected function sendMessage($level, $message, array $context = [])
    {
        $levelAssigned = $this->logman->getLoggerAssigndTo($level);

        foreach ($levelAssigned as $logger) {
            $is = 'is' . ucfirst($level);
            if ($this->logman->{$is}()) {
                $logger->{$level}($message, $context);
            }
        }
    }
}
