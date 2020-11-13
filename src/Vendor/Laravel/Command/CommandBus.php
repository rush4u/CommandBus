<?php declare(strict_types=1);

namespace Rush4u\CommandBus\Vendor\Laravel\Command;

use Rush4u\CommandBus\CommandInterface;
use Rush4u\CommandBus\Command\CommandBusInterface;

class CommandBus implements CommandBusInterface
{
    public function dispatch(CommandInterface $command):void
    {
        app(get_class($command)."Handler")($command);
    }
}
