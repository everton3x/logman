<?php
namespace LogMan;

use LogMan\Messenger\MessengerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Gerenciador de loggers.
 *
 * @author Everton
 */
class LogMan
{

    /**
     * 
     * @var array Vincula loggers aos níves de log através do método self::assignLoggerTo()
     */
    protected array $levelAssign = [];

    /**
     *
     * @var array Armazena o status ativado/desativado de cada um dos levels.
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
     * 
     */
    public function __construct()
    {
        
    }

    protected function assignLoggerToLevel(string $level, LoggerInterface ...$logger): void
    {
//        print_r($this->levelAssign);exit();
        if (key_exists($level, $this->levelAssign)) {
            $this->levelAssign[$level] = array_merge(
                $this->levelAssign[$level],
                $logger
            );
        } else {
            $this->levelAssign[$level] = $logger;
        }
    }

    public function assignLoggerToAlertLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::ALERT, ...$logger);
        return $this;
    }

    public function assignLoggerToCriticalLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::CRITICAL, ...$logger);
        return $this;
    }

    public function assignLoggerToErrorLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::ERROR, ...$logger);
        return $this;
    }

    public function assignLoggerToWarningLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::WARNING, ...$logger);
        return $this;
    }

    public function assignLoggerToEmergencyLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::EMERGENCY, ...$logger);
        return $this;
    }

    public function assignLoggerToNoticeLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::NOTICE, ...$logger);
        return $this;
    }

    public function assignLoggerToInfoLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::INFO, ...$logger);
        return $this;
    }

    public function assignLoggerToDebugLevel(LoggerInterface ...$logger): LogMan
    {
        $this->assignLoggerToLevel(LogLevel::DEBUG, ...$logger);
        return $this;
    }

    /**
     * Retorna uma instância de um mensageiro.
     * 
     * @param string $messengerName
     * @return MessengerInterface
     */
    public function getMessenger(string $messengerName = 'default'): MessengerInterface
    {
        $messengerClassName = '\\LogMan\\Messenger\\' . ucfirst($messengerName) . 'Messenger';

        return new $messengerClassName($this);
    }

    protected function isMode(string $mode): bool
    {
        return $this->levelActive[$mode];
    }

    public function isEmergency(): bool
    {
        return $this->isMode(LogLevel::EMERGENCY);
    }

    public function isAlert(): bool
    {
        return $this->isMode(LogLevel::ALERT);
    }

    public function isCritical(): bool
    {
        return $this->isMode(LogLevel::CRITICAL);
    }

    public function isError(): bool
    {
        return $this->isMode(LogLevel::ERROR);
    }

    public function isWarning(): bool
    {
        return $this->isMode(LogLevel::WARNING);
    }

    public function isNotice(): bool
    {
        return $this->isMode(LogLevel::NOTICE);
    }

    public function isInfo(): bool
    {
        return $this->isMode(LogLevel::INFO);
    }

    public function isDebug(): bool
    {
        return $this->isMode(LogLevel::DEBUG);
    }

    public function getLoggerAssigndTo(string $logLevel): array
    {
        return $this->levelAssign[$logLevel];
    }

    public function getLoggerToEmergency(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::EMERGENCY);
    }

    public function getLoggerToAlert(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::ALERT);
    }

    public function getLoggerToCritical(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::CRITICAL);
    }

    public function getLoggerToError(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::ERROR);
    }

    public function getLoggerToWarning(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::WARNING);
    }

    public function getLoggerToNotice(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::NOTICE);
    }

    public function getLoggerToInfo(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::INFO);
    }

    public function getLoggerToDebug(): array
    {
        return $this->getLoggerAssigndTo(LogLevel::DEBUG);
    }

    protected function toggleLevelActive(string $level, bool $toggle)
    {
        $this->levelActive[$level] = $toggle;
    }

    public function toggleEmergency(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::EMERGENCY, $toggle);
        return $this;
    }

    public function toggleAlert(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::ALERT, $toggle);
        return $this;
    }

    public function toggleCritical(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::CRITICAL, $toggle);
        return $this;
    }

    public function toggleError(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::ERROR, $toggle);
        return $this;
    }

    public function toggleWarning(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::WARNING, $toggle);
        return $this;
    }

    public function toggleNotice(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::NOTICE, $toggle);
        return $this;
    }

    public function toggleInfo(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::INFO, $toggle);
        return $this;
    }

    public function toggleDebug(bool $toggle): LogMan
    {
        $this->toggleLevelActive(LogLevel::DEBUG, $toggle);
        return $this;
    }
}
