<?php

namespace AwdStudio\Tests\CommandBus\Simple;

use AwdStudio\CommandBus\Exception\HandlerAlreadyExists;
use AwdStudio\CommandBus\Exception\HandlerNotFound;
use AwdStudio\CommandBus\Simple\ArrayCollection;
use AwdStudio\Tests\CommandBus\Stubs\Command\CommandA;
use AwdStudio\Tests\CommandBus\Stubs\Handler\CommandAHandler;
use PHPUnit\Framework\TestCase;

class ArrayHandlersCollectionTest extends TestCase
{

    /**
     * Instance.
     *
     * @var ArrayCollection
     */
    private $instance;

    /** @var \AwdStudio\Tests\CommandBus\Stubs\Command\CommandA */
    private $commandA;

    /** @var \AwdStudio\Tests\CommandBus\Stubs\Handler\CommandAHandler */
    private $handlerA;


    /**
     * Settings up.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->instance = new ArrayCollection();
        $this->commandA = new CommandA();
        $this->handlerA = new CommandAHandler();
    }

    /**
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::add
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::contains
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::commandName
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::isset
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     */
    public function testAdd()
    {
        $actual = $this->instance->add($this->handlerA);

        $this->assertInstanceOf(ArrayCollection::class, $actual);
    }

    /**
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::add
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::contains
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::commandName
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::isset
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     */
    public function testAddException()
    {
        $this->expectException(HandlerAlreadyExists::class);

        $this->instance->add($this->handlerA);
        $this->instance->add($this->handlerA);
    }

    /**
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::remove
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::contains
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::commandName
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::isset
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function testRemove()
    {
        $this->instance->add($this->handlerA);
        $actual = $this->instance->remove($this->handlerA);

        $this->assertInstanceOf(ArrayCollection::class, $actual);
    }

    /**
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::remove
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::contains
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::commandName
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::isset
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function testRemoveException()
    {
        $this->expectException(HandlerNotFound::class);

        $this->instance->remove($this->handlerA);
    }

    /**
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::add
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::contains
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::commandName
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::findHandler
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function testFindHandler()
    {
        $this->instance->add($this->handlerA);
        $actual = $this->instance->findHandler($this->commandA);

        $this->assertInstanceOf(CommandAHandler::class, $actual);
    }

    /**
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::contains
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::commandName
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::isset
     * @covers \AwdStudio\CommandBus\Simple\ArrayCollection::findHandler
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function testFindHandlerException()
    {
        $this->expectException(HandlerNotFound::class);

        $this->instance->findHandler($this->commandA);
    }

}
