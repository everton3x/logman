<?php
namespace LogMan\Messenger;

use LogMan\LogMan;
use LogMan\Messenger\MessengerInterface;
use Psr\Log\LogLevel;

/**
 * Default messenger
 *
 * @author Everton da Rosa
 */
class DefaultMessenger implements MessengerInterface
{

    /**
     *
     * @var LogMan
     */
    protected LogMan $logman;

    /**
     * 
     * @param LogMan $logman
     */
    public function __construct(LogMan $logman)
    {
        $this->logman = $logman;
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::emergency()
     */
    public function emergency($message, array $context = [])
    {
        $this->sendMessage(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::alert()
     */
    public function alert($message, array $context = [])
    {
        $this->sendMessage(LogLevel::ALERT, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::critical()
     */
    public function critical($message, array $context = [])
    {
        $this->sendMessage(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::error()
     */
    public function error($message, array $context = [])
    {
        $this->sendMessage(LogLevel::ERROR, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::warning()
     */
    public function warning($message, array $context = [])
    {
        $this->sendMessage(LogLevel::WARNING, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::notice()
     */
    public function notice($message, array $context = [])
    {
        $this->sendMessage(LogLevel::NOTICE, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::info()
     */
    public function info($message, array $context = [])
    {
        $this->sendMessage(LogLevel::INFO, $message, $context);
    }

    /**
     * 
     * @param type $message
     * @param array $context
     * @see MessengerInterface::debug()
     */
    public function debug($message, array $context = [])
    {
        $this->sendMessage(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Sends the message to the appropriate loggers according to the log 
     * level signed.
     * 
     * @param type $level
     * @param type $message
     * @param array $context
     */
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
