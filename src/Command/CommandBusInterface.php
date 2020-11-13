<?php

namespace Rush4u\CommandBus\Command;

use Rush4u\CommandBus\CommandInterface;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command):void;
}
