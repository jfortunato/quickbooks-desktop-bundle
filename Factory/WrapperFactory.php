<?php

namespace Jfortunato\QuickBooksDesktopBundle\Factory;

use Jfortunato\QuickBooksDesktopBundle\Config\ConfigInterface;
use Jfortunato\QuickBooksDesktopBundle\Mapping\MapperInterface;
use Jfortunato\QuickBooksDesktopBundle\Wrapper\Server;
use Jfortunato\QuickBooksDesktopBundle\Wrapper\Utilities;

class WrapperFactory implements WrapperFactoryInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function newServer(MapperInterface $mapper)
    {
        $server = new \QuickBooks_WebConnector_Server(
            $this->config->getDsn(),
            $mapper->getMap(),
            $mapper->getErrMap(),
            $mapper->getHookMap(),
            $this->config->getLogLevel(),
            $this->config->getSoapServer(),
            QUICKBOOKS_WSDL,
            [],
            $this->config->getHandlerOptions(),
            $this->config->getDriverOptions(),
            []
        );

        return new Server($server);
    }

    public function newUtilities()
    {
        return new Utilities(new \QuickBooks_Utilities);
    }
}
