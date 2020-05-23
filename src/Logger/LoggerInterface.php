<?php
namespace LogMan\Logger;

use Psr\Log\LoggerInterface;

/**
 * Logger interface, compatible with \ Psr \ Log \ LoggerInterface and PSR-3.
 * 
 * A Logger is a class instance that implements methods for recording messages according to PSR-3.
 * 
 * @author Everton da Rosa
 * @link https://www.php-fig.org/psr/psr-3/ PSR-3 on PPHP-FIG.
 */
interface LoggerInterface extends LoggerInterface
{

    /**
     * Getter for the name of the logger. Useful for debugging and for linking messages to the logger.
     * 
     * @return string
     */
    public function getLoggerName(): string;

    /**
     * Setter for the name of logger.
     * 
     * @param string $name
     */
    public function setLoggerName(string $name);
}
