<?php

declare(strict_types=1); // strict mode

namespace AwdStudio\Tests\CommandBus\Stubs\Handler;

use AwdStudio\CommandBus\Command\Command;
use AwdStudio\CommandBus\Handler\CommandHandler;
use AwdStudio\Tests\CommandBus\Exception\TestException;
use AwdStudio\Tests\CommandBus\Stubs\Command\CommandA;

class CommandAHandler implements CommandHandler
{

    /**
     * @var \AwdStudio\Tests\CommandBus\Stubs\Command\CommandA
     */
    private $command;

    /**
     * Returns the name of a command to handle.
     *
     * @return string The full name of a command.
     */
    public function supports(): string
    {
        return CommandA::class;
    }

    /**
     * Handle a command.
     *
     * @param \AwdStudio\CommandBus\Command\Command $command
     *
     * @throws \AwdStudio\Tests\CommandBus\Exception\TestException
     */
    public function handle(Command $command): void
    {
        $this->command = $command;

        $this->execute($this->command);
    }

    /**
     * Handle a command.
     *
     * @param \AwdStudio\Tests\CommandBus\Stubs\Command\CommandA $command
     *
     * @throws \AwdStudio\Tests\CommandBus\Exception\TestException
     */
    private function execute(CommandA $command): void
    {
        $fieldA = $command->fieldA;
        $fieldB = $command->fieldB;

        $message = sprintf('fieldA = %s, fieldB = %s', $fieldA, $fieldB);
        throw new TestException($message);
    }

}
