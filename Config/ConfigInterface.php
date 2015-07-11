<?php

namespace Jfortunato\QuickBooksDesktopBundle\Config;

interface ConfigInterface
{
    public function getLogLevel();

    public function getSoapServer();

    public function getHandlerOptions();

    public function getDriverOptions();

    public function getDsn();

    public function getUser();

    public function getPass();
}
