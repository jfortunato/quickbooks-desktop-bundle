<?php

namespace Jfortunato\QuickBooksDesktopBundle\Wrapper;

abstract class BaseWrapper implements WrapperInterface
{
    public function __call($name, array $arguments)
    {
        return call_user_func_array([$this->getWrapped(), $name], $arguments);
    }
}
