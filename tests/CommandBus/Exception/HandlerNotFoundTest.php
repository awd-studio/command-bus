<?php

namespace AwdStudio\Tests\CommandBus\Exception;

use AwdStudio\CommandBus\Exception\HandlerNotFound;
use AwdStudio\Tests\CommandBus\Stubs\Command\CommandA;
use PHPUnit\Framework\TestCase;

class HandlerNotFoundTest extends TestCase
{

    /**
     * Instance.
     *
     * @var \AwdStudio\CommandBus\Command\Command
     */
    private $command;


    /**
     * Settings up.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->command = new CommandA();
    }

    /**
     * @covers \AwdStudio\CommandBus\Exception\HandlerNotFound::fromCommand
     */
    public function testFromCommand()
    {
        $actual = HandlerNotFound::fromCommand($this->command);

        $this->assertInstanceOf(HandlerNotFound::class, $actual);
    }

}
