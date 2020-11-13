<?php declare(strict_types=1);

namespace Rush4u\CommandBus\Query;

use Rush4u\CommandBus\CommandInterface;

interface QueryHandlerInterface
{
    public function __invoke(CommandInterface $command);
}
