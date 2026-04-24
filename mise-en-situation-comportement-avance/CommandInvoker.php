<?php

require_once 'CommandInterface.php';

class CommandInvoker
{
    private array $history = [];

    public function run(CommandInterface $command): void
    {
        $command->execute();
        $this->history[] = $command;
    }

    public function getHistory(): array
    {
        return $this->history;
    }
}