<?php

namespace N3xt0r\BitbucketRepositoryBackup\Console;

use Symfony\Component\Console\Command\Command;

abstract class BaseCommand extends Command
{

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
            var_dump($name);
        }

        return $name;
    }
}