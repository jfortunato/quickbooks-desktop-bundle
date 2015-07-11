<?php

namespace spec\Jfortunato\QuickBooksDesktopBundle\Config;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Jfortunato\QuickBooksDesktopBundle\Config\ConfigInterface;

class ConfigSpec extends ObjectBehavior
{
    function let(Connection $connection)
    {
        $this->beConstructedWith([], $connection);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jfortunato\QuickBooksDesktopBundle\Config\Config');
    }

    function it_should_implement_ConfigInterface()
    {
        $this->shouldImplement(ConfigInterface::class);
    }

    function it_should_have_some_default_options()
    {
        $this->getLogLevel()->shouldReturn(QUICKBOOKS_LOG_NORMAL);
        $this->getSoapServer()->shouldReturn(QUICKBOOKS_SOAPSERVER_BUILTIN);
        $this->getHandlerOptions()->shouldReturn(['deny_concurrent_logins' => false, 'deny_reallyfast_logins' => false]);
        $this->getDriverOptions()->shouldReturn(['max_log_history' => 32000, 'max_queue_history' => 1024]);
    }

    function it_should_throw_exception_if_required_configs_are_not_set()
    {
        $this->shouldThrow('Exception')->duringGetUser();
        $this->shouldThrow('Exception')->duringGetPass();
    }

    function it_should_evaluate_log_level_string_as_constant($connection)
    {
        $config = ['log_level' => 'QUICKBOOKS_LOG_DEVELOP'];
        $this->beConstructedWith($config, $connection);
        $this->getLogLevel()->shouldReturn(QUICKBOOKS_LOG_DEVELOP);
    }

    function it_should_evaluate_soap_server_string_as_constant($connection)
    {
        $config = ['soap_server' => 'QUICKBOOKS_SOAPSERVER_PHP'];
        $this->beConstructedWith($config, $connection);
        $this->getSoapServer()->shouldReturn(QUICKBOOKS_SOAPSERVER_PHP);
    }

    function it_should_get_values_from_config_array($connection)
    {
        $config = [
            'log_level' => 'QUICKBOOKS_LOG_DEVELOP',
            'soap_server' => 'QUICKBOOKS_SOAPSERVER_PHP',
            'handler_options' => ['foo' => 'bar'],
            'driver_options' => ['baz' => 'bing'],
            'user' => 'foouser',
            'pass' => 'foopass',
        ];

        $this->beConstructedWith($config, $connection);
        $this->getLogLevel()->shouldReturn(QUICKBOOKS_LOG_DEVELOP);
        $this->getSoapServer()->shouldReturn(QUICKBOOKS_SOAPSERVER_PHP);
        $this->getHandlerOptions()->shouldReturn(['foo' => 'bar']);
        $this->getDriverOptions()->shouldReturn(['baz' => 'bing']);
        $this->getUser()->shouldReturn('foouser');
        $this->getPass()->shouldReturn('foopass');
    }

    function it_should_get_dsn_from_connection($connection, Driver $driver)
    {
        $connection->getDriver()->willReturn($driver);
        $driver->getName()->willReturn('mysqli');
        $connection->getUsername()->willReturn('foo');
        $connection->getPassword()->willReturn('password');
        $connection->getHost()->willReturn('localhost');
        $connection->getDatabase()->willReturn('testdb');

        $this->getDsn()->shouldReturn('mysqli://foo:password@localhost/testdb');
    }
}
