<?php

namespace N3xt0r\BitbucketRepositoryBackup\Config;

use Symfony\Component\Yaml\Yaml;

class YamlConfig
{

    protected array $config = [];

    protected string $pathToConfig = '';

    public function __construct(string $pathToConfig)
    {
        $this->setPathToConfig($pathToConfig);
    }

    public function getPathToConfig(): string
    {
        return $this->pathToConfig;
    }

    public function setPathToConfig(string $pathToConfig): void
    {
        $this->pathToConfig = $pathToConfig;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function loadConfig(): bool
    {
        $result = false;
        $path = $this->getPathToConfig();
        if (file_exists($path)) {
            $config = Yaml::parseFile($this->getPathToConfig());
            var_dump($config);
            $this->setConfig($config);
            $result = true;
        }

        return $result;
    }
}