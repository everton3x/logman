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
     * @var string Template for messages. This supports the following placeholders: level, time, message, loggerName
     */
    protected string $template = "[{level}]\t\t{time}\t{message} in {loggerName}\n\r";

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

        if ($context) {
            $message = $this->applyContext($message, $context);
        }

        $levelAssigned = $this->logman->getLoggerAssigndTo($level);
        $time = date('Y-m-d H:i:s');

        foreach ($levelAssigned as $logger) {

            $message = $this->applyTemplate([
                'level' => $level,
                'time' => $time,
                'message' => $message,
                'loggerName' => $logger->getLoggerName()
            ]);

            $is = 'is' . ucfirst($level);
            if ($this->logman->{$is}()) {
                $logger->{$level}($message, $context);
            }
        }
    }

    /**
     * Placeholder names MUST correspond to keys in the context array.
     * 
     * Placeholder names MUST be delimited with a single opening brace { and 
     * a single closing brace }. There MUST NOT be any whitespace between the 
     * delimiters and the placeholder name.
     * 
     * Placeholder names SHOULD be composed only of the characters A-Z, a-z, 
     * 0-9, underscore _, and period ..
     * 
     * @param string $message
     * @param array $context
     * @return string
     * @link https://www.php-fig.org/psr/psr-3/ PSR-3 in PHP-FIG.
     */
    protected function applyContext(string $message, array $context): string
    {
        foreach ($context as $key => $value) {
            $message = preg_replace("/\{$key\}/", $value, $message);
        }

        return $message;
    }

    protected function applyTemplate(array $placeholder): string
    {
        $message = $this->template;
        foreach ($placeholder as $key => $value) {
            $message = preg_replace("/\{$key\}/", $value, $message);
        }

        return $message;
    }

    /**
     * Setter for the message template.
     * 
     * @param string $template
     * @see DefaultMessenger::$template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    /**
     * Getter for the message template.
     * 
     * @return string
     * @see DefaultMessenger::$template
     */
    public function getTemplate(): string
    {
        return $this->template;
    }
}
