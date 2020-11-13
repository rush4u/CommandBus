<?php

namespace Rush4u\CommandBus\Command;

use Rush4u\CommandBus\CommandInterface;

interface CommandHandlerInterface
{
    public function __invoke(CommandInterface $command):void;
}
