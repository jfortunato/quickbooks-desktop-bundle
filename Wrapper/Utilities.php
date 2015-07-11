<?php

namespace Jfortunato\QuickBooksDesktopBundle\Wrapper;

class Utilities extends BaseWrapper
{
    /**
     * @var \QuickBooks_Utilities
     */
    private $utilities;

    /**
     * Utilities constructor.
     */
    public function __construct(\QuickBooks_Utilities $utilities)
    {
        $this->utilities = $utilities;
    }

    public function getWrapped()
    {
        return $this->utilities;
    }

    public static function __callStatic($name, array $arguments)
    {
        return forward_static_call_array(['\QuickBooks_Utilities', $name], $arguments);
    }
}
