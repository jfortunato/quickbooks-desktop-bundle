<?php

namespace Jfortunato\QuickBooksDesktopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class QuickBooksDesktopController extends Controller
{
    public function qbwcAction()
    {
        // Set up our queue singleton
        \QuickBooks_WebConnector_Queue_Singleton::initialize($this->container->get('jfortunato_quick_books_desktop.config')->getDsn());

        $server = $this->container->get('jfortunato_quick_books_desktop.wrapper.server');
        $handled = $server->handle(true, true);

        $response = new Response;

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
