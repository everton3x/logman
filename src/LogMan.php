<?php
namespace LogMan;

use LogMan\Messenger\MessengerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * LogMan is a logger manager that creates an environment capable of providing 
 * different levels of logging and an on-the-fly configuration for the developer.
 *
 * @author Everton da Rosa
 */
class LogMan
{

    /**
     * 
     * @var array Links loggers to log levels using the LogMan::assignLoggerTo() method
     */
    protected array $levelAssign = [];

    /**
     *
     * @var array Stores the on / off status of each level.
     */
    protected array $levelActive = [
        LogLevel::EMERGENCY => true,
        LogLevel::ALERT => true,
        LogLevel::CRITICAL => true,
        LogLevel::ERROR => true,
        LogLevel::WARNING => true,
        LogLevel::NOTICE => true,
        LogLevel::INFO => true,
        LogLevel::DEBUG => false,
    ];

    /**
     * Constructor.
     */
    public function __construct()
    {
        
    }

    /**
     * Sign one or more loggers at a log level.
     * 
     * @param string $level
     * @param LoggerInterface $logger
     * @return void
     */
    protected function assignLoggerToLevel(string $level, LoggerInterface ...$logger): void
    {
        if (key_exists($level, $this->levelAssign)) {
            $this->levelAssign[$level] = array_merge(
                $this->levelAssign[$level],
                $logger
            );
        } else {
            $this->levelAssign[$level] = $logger;
        }
    }

    /**
     * Sign one or more loggers at the log alert level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToAlertLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::ALERT, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log critical level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToCriticalLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::CRITICAL, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log error level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToErrorLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::ERROR, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log warning level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToWarningLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::WARNING, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log emergency level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToEmergencyLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::EMERGENCY, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log notice level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToNoticeLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::NOTICE, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log info level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToInfoLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::INFO, ...$logger);
        return $this;
    }

    /**
     * Sign one or more loggers at the log debug level.
     * 
     * @param LoggerInterface $logger
     * @return \LogMan\LogMan
     */
    public function assignLoggerToDebugLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::DEBUG, ...$logger);
        return $this;
    }

    /**
     * Factory method of messengers.
     * 
     * @param string $messengerName It must correspond to the name of an 
     * implemented messenger class, without the suffix Messenger.
     * 
     * @return MessengerInterface
     */
    public function getMessenger(string $messengerName = 'default'): MessengerInterface
    {
        $messengerClassName = '\\LogMan\\Messenger\\' . ucfirst($messengerName) . 'Messenger';

        return new $messengerClassName($this);
    }

    /**
     * Identifies the enabled / disabled status of a logging level.
     * 
     * @param string $mode
     * @return bool
     */
    protected function isMode(string $mode): bool
    {
        return $this->levelActive[$mode];
    }

    /**
     * Identifies whether the emergency logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isEmergency(): bool
    {
        return $this->isMode(LogLevel::EMERGENCY);
    }

    /**
     * Identifies whether the alert logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isAlert(): bool
    {
        return $this->isMode(LogLevel::ALERT);
    }

    /**
     * Identifies whether the critical logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isCritical(): bool
    {
        return $this->isMode(LogLevel::CRITICAL);
    }

    /**
     * Identifies whether the error logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isError(): bool
    {
        return $this->isMode(LogLevel::ERROR);
    }

    /**
     * Identifies whether the warning logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isWarning(): bool
    {
        return $this->isMode(LogLevel::WARNING);
    }

    /**
     * Identifies whether the notice logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isNotice(): bool
    {
        return $this->isMode(LogLevel::NOTICE);
    }

    /**
     * Identifies whether the info logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isInfo(): bool
    {
        return $this->isMode(LogLevel::INFO);
    }

    /**
     * Identifies whether the debug logging level is enabled or disabled.
     * 
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->isMode(LogLevel::DEBUG);
    }

    /**
     * Getter for the list of loggers signed for a log level.
     * 
     * @param string $logLevel
     * @return array
     */
    public function getLoggerAssigndTo(string $logLevel): array
    {
        return $this->levelAssign[$logLevel];
    }

    /**
     * Getter for the list of loggers signed for emergency log level.
     * 
     * @return array
     */
    public function getLoggerToEmergency(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::EMERGENCY);
    }

    /**
     * Getter for the list of loggers signed for the alert log level.
     * 
     * @return array
     */
    public function getLoggerToAlert(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::ALERT);
    }

    /**
     * Getter for the list of loggers signed for the critical log level.
     * 
     * @return array
     */
    public function getLoggerToCritical(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::CRITICAL);
    }

    /**
     * Getter for the list of loggers signed for the error log level.
     * 
     * @return array
     */
    public function getLoggerToError(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::ERROR);
    }

    /**
     * Getter for the list of loggers signed for the warning log level.
     * 
     * @return array
     */
    public function getLoggerToWarning(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::WARNING);
    }

    /**
     * Getter for the list of loggers signed for the notice log level.
     * 
     * @return array
     */
    public function getLoggerToNotice(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::NOTICE);
    }

    /**
     * Getter for the list of loggers signed for the info log level.
     * 
     * @return array
     */
    public function getLoggerToInfo(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::INFO);
    }

    /**
     * Getter for the list of loggers signed for the debug log level.
     * 
     * @return array
     */
    public function getLoggerToDebug(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::DEBUG);
    }

    /**
     * Enables / disables a logging level.
     * 
     * @param string $level
     * @param bool $toggle
     */
    protected function toggleLevelActive(string $level, bool $toggle)
    {
        $this->levelActive[$level] = $toggle;
    }

    /**
     * Enables / disables log level for emergency.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleEmergency(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::EMERGENCY, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for alert.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleAlert(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::ALERT, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for critical.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleCritical(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::CRITICAL, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for error.
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleError(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::ERROR, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for warning.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleWarning(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::WARNING, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for notice.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleNotice(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::NOTICE, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for info.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleInfo(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::INFO, $toggle);
        return $this;
    }

    /**
     * Enables / disables log level for debug.
     * 
     * @param bool $toggle
     * @return \LogMan\LogMan
     */
    public function toggleDebug(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::DEBUG, $toggle);
        return $this;
    }
}
