<?php

namespace Jfortunato\QuickBooksDesktopBundle\Wrapper;

class Server extends BaseWrapper
{
    protected $server;

    public function __construct(\QuickBooks_WebConnector_Server $server)
    {
        $this->server = $server;
    }

    public function getWrapped()
    {
        return $this->server;
    }
}
