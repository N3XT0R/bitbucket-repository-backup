<?php

namespace N3xt0r\BitbucketRepositoryBackup\Config;

use Symfony\Component\Finder\Finder;

class YamlConfig
{

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
}