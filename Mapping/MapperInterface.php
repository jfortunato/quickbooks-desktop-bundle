<?php

namespace Jfortunato\QuickBooksDesktopBundle\Mapping;

interface MapperInterface
{
    public function getMap();

    public function getErrMap();

    public function getHookMap();
}
