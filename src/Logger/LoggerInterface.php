<?php
namespace LogMan\Logger;

use Psr\Log\LoggerInterface;

/**
 *
 * @author Everton
 */
interface LoggerInterface extends LoggerInterface
{

    public function getLoggerName(): string;

    public function setLoggerName(string $name);
}
