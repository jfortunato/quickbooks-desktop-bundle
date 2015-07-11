<?php

namespace Jfortunato\QuickBooksDesktopBundle\Factory;

use Jfortunato\QuickBooksDesktopBundle\Mapping\MapperInterface;

interface WrapperFactoryInterface
{
    public function newServer(MapperInterface $mapper);
}
