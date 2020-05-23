<?php
namespace LogMan\Messenger;

use LogMan\LogMan;

/**
 * Interface for messengers.
 * 
 * A messenger is a class that sends messages to one or more loggers.
 * 
 * While LogMan is responsible for configuring the logging environment, 
 * Messenger is responsible for sending messages to registered loggers, 
 * according to the environment provided by LogMan.
 * 
 * @author Everton da Rosa
 */
interface MessengerInterface
{

    /**
     * Constructor.
     * 
     * @param LogMan $logman
     */
    public function __construct(LogMan $logman);
    
    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::emergency()
     */
    public function emergency($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::alert()
     */
    public function alert($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::critical()
     */
    public function critical($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::error()
     */
    public function error($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::warning()
     */
    public function warning($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::notice()
     */
    public function notice($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::info()
     */
    public function info($message, array $context = []);

    /**
     * 
     * @param type $message
     * @param array $context
     * @see \Psr\Log\LoggerInterface::debug()
     */
    public function debug($message, array $context = []);
    
    /**
     * Setter for the message template.
     * 
     * @param string $template
     */
    public function setTemplate(string $template);
    
    /**
     * Getter for the message template.
     * @return string
     */
    public function getTemplate(): string;
}
