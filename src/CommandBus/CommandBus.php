<?php

namespace AwdStudio\CommandBus;

use AwdStudio\CommandBus\Command\Command;
use AwdStudio\CommandBus\Exception\HandlerNotFound;
use AwdStudio\CommandBus\Handler\HandlersCollection;

class CommandBus
{

    /**
     * @var \AwdStudio\CommandBus\Handler\HandlersCollection
     */
    private $handlersCollection;

    /**
     * CommandBus constructor.
     *
     * @param \AwdStudio\CommandBus\Handler\HandlersCollection $handlersCollection
     */
    public function __construct(HandlersCollection $handlersCollection)
    {
        $this->handlersCollection = $handlersCollection;
    }

    /**
     * Executes a handler of the command.
     *
     * @param \AwdStudio\CommandBus\Command\Command $command
     *
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function handle(Command $command): void
    {
        try {
            $handler = $this->handlersCollection->findHandler($command);
        } catch (HandlerNotFound $e) {
            throw HandlerNotFound::fromCommand($command);
        }

        $handler->handle($command);
    }

}
