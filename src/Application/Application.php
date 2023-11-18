<?php

namespace N3xt0r\BitbucketRepositoryBackup\Application;

use Monolog\Handler\SyslogHandler;
use Monolog\Logger;
use N3xt0r\BitbucketRepositoryBackup\Config\YamlConfig;
use N3xt0r\BitbucketRepositoryBackup\Console\BaseCommand;
use N3xt0r\BitbucketRepositoryBackup\Console\CreateBackupCommand;
use Symfony\Component\Console\Application as SymfonyApplication;

final class Application
{

    protected array $config = [];

    private const configPath = '../../config/config.yml';

    protected Logger $logger;

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

    public function getLogger(): Logger
    {
        return $this->logger;
    }

    public function setLogger(Logger $logger): void
    {
        $this->logger = $logger;
    }

    public function run(): int
    {
        $exitCode = 0;
        $logger = $this->createLogger();
        $this->setLogger($logger);
        try {
            $application = new SymfonyApplication();
            $this->registerCommands($application);
            $exitCode = $application->run();
        } catch (\Throwable $e) {
            $logger->error($e->getMessage(), ['context' => $e]);
        }
        return $exitCode;
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

    protected function createLogger(): Logger
    {
        $logger = new Logger('log');
        $logger->pushHandler(new SyslogHandler('bitbucket-repository-backup'));
    }

}