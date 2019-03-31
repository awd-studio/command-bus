<?php

declare(strict_types=1); // strict mode

namespace AwdStudio\Tests\CommandBus\Stubs\Command;

use AwdStudio\CommandBus\Command\Command;

class CommandB implements Command
{

    public $fieldA;

    public $fieldB;

    /**
     * CommandA constructor.
     *
     * @param mixed $fieldA
     * @param mixed $fieldB
     */
    public function __construct($fieldA = 'A', $fieldB = 'B')
    {
        $this->fieldA = $fieldA;
        $this->fieldB = $fieldB;
    }

}
