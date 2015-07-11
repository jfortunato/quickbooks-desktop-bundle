<?php

namespace spec\Jfortunato\QuickBooksDesktopBundle\Wrapper;

use Jfortunato\QuickBooksDesktopBundle\Wrapper\WrapperInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ServerSpec extends ObjectBehavior
{
    function let(\QuickBooks_WebConnector_Server $server)
    {
        $this->beConstructedWith($server);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jfortunato\QuickBooksDesktopBundle\Wrapper\Server');
    }

    function it_should_implement_WrapperInterface()
    {
        $this->shouldImplement(WrapperInterface::class);
    }

    function it_should_wrap_QuickBooks_WebConnector_Server()
    {
        $this->getWrapped()->shouldReturnAnInstanceOf('QuickBooks_WebConnector_Server');
    }

    function it_should_call_handle_method_of_wrapped_class($server)
    {
        $server->handle()->shouldBeCalled()->willReturn(true);
        $this->handle()->shouldReturn(true);
    }
}
