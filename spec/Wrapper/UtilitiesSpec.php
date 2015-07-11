<?php

namespace spec\Jfortunato\QuickBooksDesktopBundle\Wrapper;

use Jfortunato\QuickBooksDesktopBundle\Wrapper\Utilities;
use Jfortunato\QuickBooksDesktopBundle\Wrapper\WrapperInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UtilitiesSpec extends ObjectBehavior
{
    function let(\QuickBooks_Utilities $utilities)
    {
        $this->beConstructedWith($utilities);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jfortunato\QuickBooksDesktopBundle\Wrapper\Utilities');
    }

    function it_should_implement_WrapperInterface()
    {
        $this->shouldImplement(WrapperInterface::class);
    }

    function it_should_wrap_QuickBooks_Utilities()
    {
        $this->getWrapped()->shouldReturnAnInstanceOf('QuickBooks_Utilities');
    }

    function it_should_forward_static_calls_to_wrapped()
    {
        $date = (new \DateTime)->format('Y-m-d');
        $result = Utilities::date();
        $this->assertEquals($date, $result);
    }

    protected function assertEquals($expected, $actual)
    {
        if ($expected !== $actual) {
            throw new \Exception;
        }
    }
}
