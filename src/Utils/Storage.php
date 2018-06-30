<?php

namespace Utils;

class Storage
{
    private $client;

    public function __construct($scheme, $host, $port, $password)
    {
        $this->client = new \Predis\Client([
            'scheme'   => $scheme,
            'host'     => $host,
            'port'     => $port,
            'password' => $password
        ]);
    }

    public function incr(string $key)
    {
        return $this->client->incr($key);
    }

    public function get(string $key)
    {
        return $this->client->get($key);
    }
}