<?php declare(strict_types=1);

namespace Rush4u\CommandBus\Vendor\Laravel\Query;

use Illuminate\Contracts\Container\Container;
use Rush4u\CommandBus\CommandInterface;
use Rush4u\CommandBus\Query\QueryBusInterface;

class QueryBus implements QueryBusInterface
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch(CommandInterface $command):array
    {
        $handler = $this->container->make(get_class($command)."Handler"::class);

        return $handler->__invoke($command);
    }
}
