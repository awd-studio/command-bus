# AWD Command Bus

Provides a simple implementation of the Command bus pattern.

### Install
```bash
composer require awd-studio/command-bus
```

### Usage

- Implement a `\AwdStudio\CommandBus\Handler\HandlersCollection` (or use a defined one - `\AwdStudio\CommandBus\Simple\ArrayCollection`)
- Register there all off handlers (must implement `AwdStudio\CommandBus\Handler\CommandHandler` interface)
- And then - you'll be able to use the bus (`AwdStudio\CommandBus\CommandBus`):
```php
<?php

use \AwdStudio\CommandBus\CommandBus;
use \AwdStudio\CommandBus\Simple\ArrayCollection;

// Creating the handlers collection
$handlers = new ArrayCollection();

// Fill it with handlers
$handlers->add(new MyCommandAHandler());
$handlers->add(new MyCommandBHandler());

// Remove handlers, if it's required
$handlers->remove(new MyCommandCHandler());

// Creating the bus
$bus = new CommandBus($handlers);

// Handle commands
$bus->handle(new MyCommandA());
$bus->handle(new MyCommandB());
```

### Testing

To run tests - execute next script:
```bash
composer test
# or with coverage
composer coverage
```
