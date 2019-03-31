<?php

namespace AwdStudio\Tests\CommandBus;

use AwdStudio\CommandBus\CommandBus;
use AwdStudio\CommandBus\Exception\HandlerNotFound;
use AwdStudio\CommandBus\Handler\HandlersCollection;
use AwdStudio\Tests\CommandBus\Stubs\Command\CommandA;
use AwdStudio\Tests\CommandBus\Stubs\Command\CommandB;
use AwdStudio\Tests\CommandBus\Stubs\Handler\CommandAHandler;
use AwdStudio\Tests\CommandBus\Stubs\Handler\CommandBHandler;
use AwdStudio\Tests\CommandBus\Stubs\Handler\StubCollection;
use PHPUnit\Framework\TestCase;

class CommandBusTest extends TestCase
{

    /**
     * Instance.
     *
     * @var CommandBus
     */
    private $instance;

    /** @var \AwdStudio\CommandBus\Command\Command */
    private $commandA;

    /** @var \AwdStudio\CommandBus\Handler\CommandHandler */
    private $handlerA;

    /** @var \AwdStudio\CommandBus\Command\Command */
    private $commandB;

    /** @var \AwdStudio\CommandBus\Handler\CommandHandler */
    private $handlerB;

    /** @var HandlersCollection */
    private $collection;


    /**
     * Settings up.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->collection = new StubCollection();
        $this->commandA = new CommandA();
        $this->handlerA = new CommandAHandler();
        $this->commandB = new CommandB();
        $this->handlerB = new CommandBHandler();
        $this->instance = new CommandBus($this->collection);
    }

    /**
     * @covers \AwdStudio\CommandBus\CommandBus::__construct
     */
    public function test__construct()
    {
        $this->assertInstanceOf(CommandBus::class, new CommandBus($this->collection));
    }

    /**
     * @covers \AwdStudio\CommandBus\CommandBus::handle
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function testHandle()
    {
        $message = 'fieldA = A, fieldB = B';
        $this->expectExceptionMessage($message);

        $this->collection->add($this->handlerA);
        $this->collection->add($this->handlerB);
        $bus = new CommandBus($this->collection);
        $bus->handle($this->commandB);
        $bus->handle($this->commandA);
    }

    /**
     * @covers \AwdStudio\CommandBus\CommandBus::handle
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function testHandleException()
    {
        $this->expectException(HandlerNotFound::class);

        $bus = new CommandBus($this->collection);
        $bus->handle($this->commandA);
    }

}
