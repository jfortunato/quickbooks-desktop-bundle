<?php

namespace Jfortunato\QuickBooksDesktopBundle\Config;

use Doctrine\DBAL\Connection;

class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var Connection
     */
    private $connection;

    public function __construct(array $config, Connection $connection)
    {
        $this->config = array_merge($this->defaults(), $config);
        $this->connection = $connection;
    }

    public function getLogLevel()
    {
        return constant($this->config['log_level']);
    }

    public function getSoapServer()
    {
        return constant($this->config['soap_server']);
    }

    public function getHandlerOptions()
    {
        return $this->config['handler_options'];
    }

    public function getDriverOptions()
    {
        return $this->config['driver_options'];
    }

    public function getDsn()
    {
        $driver = $this->connection->getDriver()->getName();
        $user = $this->connection->getUsername();
        $pass = $this->connection->getPassword();
        $host = $this->connection->getHost();
        $db = $this->connection->getDatabase();

        return "{$driver}://{$user}:{$pass}@{$host}/{$db}";
    }

    public function getUser()
    {
        if (isset($this->config['user'])) {
            return $this->config['user'];
        }

        throw new \Exception('User must be configured.');
    }

    public function getPass()
    {
        if (isset($this->config['pass'])) {
            return $this->config['pass'];
        }

        throw new \Exception('Pass must be configured.');
    }

    protected function defaults()
    {
        return [
            'log_level' => 'QUICKBOOKS_LOG_NORMAL',
            'soap_server' => 'QUICKBOOKS_SOAPSERVER_BUILTIN',
            'handler_options' => [
                'deny_concurrent_logins' => false,
                'deny_reallyfast_logins' => false,
            ],
            'driver_options' => [
                'max_log_history' => 32000,
                'max_queue_history' => 1024,
            ],
        ];
    }
}
