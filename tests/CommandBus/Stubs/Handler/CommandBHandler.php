<?php

declare(strict_types=1); // strict mode

namespace AwdStudio\Tests\CommandBus\Stubs\Handler;

use AwdStudio\CommandBus\Command\Command;
use AwdStudio\CommandBus\Handler\CommandHandler;
use AwdStudio\Tests\CommandBus\Stubs\Command\CommandB;

class CommandBHandler implements CommandHandler
{

    /**
     * @var \AwdStudio\Tests\CommandBus\Stubs\Command\CommandB
     */
    private $command;

    /**
     * Returns the name of a command to handle.
     *
     * @return string The full name of a command.
     */
    public function supports(): string
    {
        return CommandB::class;
    }

    /**
     * Handle a command.
     *
     * @param \AwdStudio\CommandBus\Command\Command $command
     */
    public function handle(Command $command): void
    {
        $this->command = $command;

        $this->execute($this->command);
    }

    /**
     * Handle a command.
     *
     * @param \AwdStudio\Tests\CommandBus\Stubs\Command\CommandB $command
     */
    private function execute(CommandB $command): void
    {
        $fieldA = $command->fieldA;
        $fieldB = $command->fieldB;
    }

}
