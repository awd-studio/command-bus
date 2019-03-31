<?php

namespace AwdStudio\CommandBus\Handler;

use AwdStudio\CommandBus\Command\Command;

interface CommandHandler
{

    /**
     * Returns the name of a command to handle.
     *
     * @return string The full name of a command.
     */
    public function supports(): string;

    /**
     * Handle a command.
     *
     * @param Command $command
     */
    public function handle(Command $command): void;

}
