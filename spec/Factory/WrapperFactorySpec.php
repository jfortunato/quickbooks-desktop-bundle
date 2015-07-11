<?php

namespace spec\Jfortunato\QuickBooksDesktopBundle\Factory;

use Jfortunato\QuickBooksDesktopBundle\Config\ConfigInterface;
use Jfortunato\QuickBooksDesktopBundle\Factory\WrapperFactoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WrapperFactorySpec extends ObjectBehavior
{
    function let(ConfigInterface $config)
    {
        $this->beConstructedWith($config);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jfortunato\QuickBooksDesktopBundle\Factory\WrapperFactory');
    }

    function it_should_implement_WrapperFactoryInterface()
    {
        $this->shouldImplement(WrapperFactoryInterface::class);
    }
}
