<?php declare(strict_types=1);

namespace Rush4u\CommandBus\Vendor\Laravel\Traits;

use Rush4u\CommandBus\CommandInterface;
use Rush4u\CommandBus\Command\CommandBusInterface;
use Rush4u\CommandBus\Query\QueryBusInterface;

trait CommandBusControllerTrait
{
    protected function dispatchCommand(CommandInterface $command)
    {
        app(CommandBusInterface::class)->dispatch($command);
    }

    protected function dispatchQuery(CommandInterface $command):array
    {
        return app(QueryBusInterface::class)->dispatch($command);
    }
}
