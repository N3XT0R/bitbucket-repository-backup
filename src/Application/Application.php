<?php

namespace N3xt0r\BitbucketRepositoryBackup\Application;

use N3xt0r\BitbucketRepositoryBackup\Console\CreateBackupCommand;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Command\Command;

final class Application
{

    protected array $commands = [
        CreateBackupCommand::class,
    ];

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
            if (class_exists($command)) {
                $instance = new $command();
                if ($instance instanceof Command) {
                    $application->add($instance);
                }
            }
        }
    }

}