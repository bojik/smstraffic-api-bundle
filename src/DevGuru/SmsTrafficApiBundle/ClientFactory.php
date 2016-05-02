<?php
namespace DevGuru\SmsTrafficApiBundle;

use DevGuru\SmsTrafficApi\Client;
use DevGuru\SmsTrafficApiBundle\Config\SmsTrafficApiConfig;
use Monolog\Logger;

class ClientFactory
{
    /**
     * @var SmsTrafficApiConfig
     */
    protected $config;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * ClientFactory constructor.
     * @param SmsTrafficApiConfig $config
     * @param Logger              $logger
     */
    public function __construct(SmsTrafficApiConfig $config, Logger $logger)
    {
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * Create new SMS Traffic client and init it with config parameters
     * @param Logger|null $logger if logger is not set it uses default logger
     * @return Client
     */
    public function create(Logger $logger = null)
    {
        $class = $this->config->getClientClass();
        /** @var Client $client */
        $client = new $class($this->config->getLogin(), $this->config->getPassword(), $this->config->getOriginator());
        if ($apiUrl = $this->config->getApiUrl()) {
            $client->setApiUrl($apiUrl);
        }

        if (!$logger instanceof Logger) {
            $logger = $this->logger;
        }

        $client->setPreRequestCallback(function ($params, $url) use ($logger) {
            $logger->info('Request to '.$url);
            $logger->debug('Request parameters', $params);
        });

        $client->setPostRequestCallback(function ($ret) use ($logger) {
            $logger->info('Request result', $ret);
        });

        return $client;
    }

    /**
     * Set logger
     * @param Logger $logger
     * @return self
     */
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;

        return $this;
    }
}
