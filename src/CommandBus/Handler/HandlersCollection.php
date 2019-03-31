<?php

declare(strict_types=1); // strict mode

namespace AwdStudio\CommandBus\Handler;

use AwdStudio\CommandBus\Command\Command;

interface HandlersCollection
{

    /**
     * Adds a command handler to the collection.
     *
     * @param \AwdStudio\CommandBus\Handler\CommandHandler $commandHandler A handler.
     *
     * @return \AwdStudio\CommandBus\Handler\HandlersCollection
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     */
    public function add(CommandHandler $commandHandler): self;

    /**
     * Deletes a command handler from the collection.
     *
     * @param \AwdStudio\CommandBus\Handler\CommandHandler $commandHandler
     *
     * @return \AwdStudio\CommandBus\Handler\HandlersCollection
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function remove(CommandHandler $commandHandler): self;

    /**
     * Returns a command handler if it exists.
     *
     * @param \AwdStudio\CommandBus\Command\Command $command
     *
     * @return \AwdStudio\CommandBus\Handler\CommandHandler
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function findHandler(Command $command): CommandHandler;

}
