<?php declare(strict_types=1);

namespace Rush4u\CommandBus\Vendor\Laravel\Command;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Facades\DB;
use Rush4u\CommandBus\CommandInterface;
use Rush4u\CommandBus\Command\CommandBusInterface;

class CommandBus implements CommandBusInterface
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch(CommandInterface $command):void
    {
        $handler = $this->container->make(get_class($command)."Handler");

        DB::transaction(function () use ($handler, $command) {
            $handler->__invoke($command);
        });
    }
}
