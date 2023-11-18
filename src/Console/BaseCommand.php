<?php

namespace N3xt0r\BitbucketRepositoryBackup\Console;

use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command
{

    protected array $config = [];

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }


    public function getName(): ?string
    {
        $name = parent::getName();
        if (null === $name) {
            $name = strtolower(
                preg_replace('/(?<!^)[A-Z]/',
                    ':$0',
                    str_replace(
                        ['N3xt0r\\BitbucketRepositoryBackup\\', 'Console', 'Command', '\\'],
                        '',
                        get_class($this))
                )
            );
        }

        return $name;
    }


}