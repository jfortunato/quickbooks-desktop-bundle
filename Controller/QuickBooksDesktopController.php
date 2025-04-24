<?php

namespace Jfortunato\QuickBooksDesktopBundle\Controller;

use Jfortunato\QuickBooksDesktopBundle\Wrapper\Server;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class QuickBooksDesktopController extends AbstractController
{
    public function qbwcAction(Server $server)
    {
        // Set up our queue singleton
        \QuickBooks_WebConnector_Queue_Singleton::initialize($this->container->get('jfortunato_quick_books_desktop.config')->getDsn());

        $handled = $server->handle(true, true);

        $response = new Response;

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
