<?php

namespace N3xt0r\BitbucketRepositoryBackup\Service;

use Bitbucket\Client;
use N3xt0r\BitbucketRepositoryBackup\Entity\AuthenticationEntity;

class BitbucketService
{
    protected ?Client $client = null;
    protected AuthenticationEntity $authenticationEntity;

    public function __construct(AuthenticationEntity $authenticationEntity)
    {
        $this->setAuthenticationEntity($authenticationEntity);
    }

    public function getClient(): Client
    {
        if (!$this->client) {
            $this->setClient(new Client());
        }
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function getAuthenticationEntity(): AuthenticationEntity
    {
        return $this->authenticationEntity;
    }

    public function setAuthenticationEntity(AuthenticationEntity $authenticationEntity): void
    {
        $this->authenticationEntity = $authenticationEntity;
    }

    protected function connect(): void
    {
        $client = $this->getClient();
        $client->authenticate(
            Client::AUTH_OAUTH_TOKEN,
        );
    }
}