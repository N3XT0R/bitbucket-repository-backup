<?php

namespace N3xt0r\BitbucketRepositoryBackup\Application;

use Symfony\Component\Console\Application as SymfonyApplication;

final class Application
{

    protected array $commands = [];

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function setCommands(array $commands): void
    {
        $this->commands = $commands;
    }

    public function run(): int
    {
        $application = new SymfonyApplication();
        $this->registerCommands($application);
        return $application->run();
    }

    protected function registerCommands(SymfonyApplication $application): void
    {
        $commands = $this->getCommands();

        foreach ($commands as $command) {
            $application->add($command);
        }
    }

}