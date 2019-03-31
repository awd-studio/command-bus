<?php

declare(strict_types=1); // strict mode

namespace AwdStudio\CommandBus\Simple;

use AwdStudio\CommandBus\Command\Command;
use AwdStudio\CommandBus\Exception\HandlerAlreadyExists;
use AwdStudio\CommandBus\Exception\HandlerNotFound;
use AwdStudio\CommandBus\Handler\CommandHandler;
use AwdStudio\CommandBus\Handler\HandlersCollection;

class ArrayCollection implements HandlersCollection
{

    /** @var array */
    private $handlers = [];

    /**
     * Adds a command handler to the collection.
     *
     * @param \AwdStudio\CommandBus\Handler\CommandHandler $commandHandler A handler.
     *
     * @return \AwdStudio\CommandBus\Handler\HandlersCollection
     * @throws \AwdStudio\CommandBus\Exception\HandlerAlreadyExists
     */
    public function add(CommandHandler $commandHandler): HandlersCollection
    {
        if ($this->contains($commandHandler)) {
            $className = \get_class($commandHandler);
            $message = \sprintf('The handler "%s" is already exists in the collection!', $className);
            throw new HandlerAlreadyExists($message);
        }

        $commandName = $this->commandName($commandHandler);
        $this->handlers[$commandName] = $commandHandler;

        return $this;
    }

    /**
     * Deletes a command handler from the collection.
     *
     * @param \AwdStudio\CommandBus\Handler\CommandHandler $commandHandler
     *
     * @return \AwdStudio\CommandBus\Handler\HandlersCollection
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function remove(CommandHandler $commandHandler): HandlersCollection
    {
        if (!$this->contains($commandHandler)) {
            $className = \get_class($commandHandler);
            $message = \sprintf('There is no a handler "%s" in the collection!', $className);
            throw new HandlerNotFound($message);
        }

        return $this;
    }

    /**
     * Returns a command handler if it exists.
     *
     * @param \AwdStudio\CommandBus\Command\Command $command
     *
     * @return \AwdStudio\CommandBus\Handler\CommandHandler
     * @throws \AwdStudio\CommandBus\Exception\HandlerNotFound
     */
    public function findHandler(Command $command): CommandHandler
    {
        $commandName = \get_class($command);
        if (!$this->isset($commandName)) {
            throw HandlerNotFound::fromCommand($command);
        }

        return $this->handlers[$commandName];
    }

    private function commandName(CommandHandler $commandHandler): string
    {
        return $commandHandler->supports();
    }

    private function isset(string $commandName): bool
    {
        return \array_key_exists($commandName, $this->handlers);
    }

    private function contains(CommandHandler $commandHandler): bool
    {
        $commandName = $this->commandName($commandHandler);
        $index = $this->isset($commandName);

        return false !== $index;
    }

}
