<?php declare(strict_types=1);

namespace Rush4u\CommandBus\Vendor\Laravel\Query;

use Rush4u\CommandBus\CommandInterface;
use Rush4u\CommandBus\Query\QueryBusInterface;

class QueryBus implements QueryBusInterface
{
    public function dispatch(CommandInterface $command):array
    {
        return app(get_class($command)."Handler"::class)->__invoke($command);
    }
}
