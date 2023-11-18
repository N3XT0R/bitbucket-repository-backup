<?php

namespace N3xt0r\BitbucketRepositoryBackup\Entity;

class AuthenticationEntity
{
    protected string $key = '';
    protected string $secret = '';

    public function __construct(string $key, string $secret)
    {
        $this->setKey($key);
        $this->setSecret($secret);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }
}