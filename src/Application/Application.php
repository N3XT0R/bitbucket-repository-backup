<?php

namespace N3xt0r\BitbucketRepositoryBackup\Application;

use N3xt0r\BitbucketRepositoryBackup\Config\YamlConfig;
use N3xt0r\BitbucketRepositoryBackup\Console\BaseCommand;
use N3xt0r\BitbucketRepositoryBackup\Console\CreateBackupCommand;
use Symfony\Component\Console\Application as SymfonyApplication;
use Symfony\Component\Console\Command\Command;

final class Application
{

    protected array $config = [];

    private const configPath = '../../config/config.yml';

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

    public function getConfig(): array
    {
        if (count($this->config) === 0) {
            $yaml = new YamlConfig(__DIR__.'/'.self::configPath);
            $yaml->loadConfig();
            $this->setConfig($yaml->getConfig());
        }


        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
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
                if ($instance instanceof BaseCommand) {
                    $instance->setConfig($this->getConfig());
                    $application->add($instance);
                }
            }
        }
    }

}