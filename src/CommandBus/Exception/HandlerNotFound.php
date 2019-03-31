<?php

namespace AwdStudio\CommandBus\Exception;

use AwdStudio\CommandBus\Command\Command;

class HandlerNotFound extends CommandBusException
{
    /**
     * Creates an exception from the command.
     *
     * @param Command $command
     *
     * @return self
     */
    public static function fromCommand(Command $command): self
    {
        $commandName = get_class($command);
        $message = sprintf('There is no a handler for the command "\%s"', $commandName);

        return new self($message);
    }
}
