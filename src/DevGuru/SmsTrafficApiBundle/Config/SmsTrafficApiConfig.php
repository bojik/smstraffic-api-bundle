<?php
namespace DevGuru\SmsTrafficApiBundle\Config;

class SmsTrafficApiConfig
{
    const PARAM_LOGIN = 'login';

    const PARAM_API_URL = 'api_url';

    const PARAM_PASSWORD = 'password';

    const PARAM_ORIGINATOR = 'originator';

    const PARAM_CLIENT_CLASS = 'client_class';

    protected $config = [];

    /**
     * SmsTrafficApiConfig constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * SMS Traffic Login defined in config
     * @return string
     */
    public function getLogin()
    {
        return $this->config[self::PARAM_LOGIN];
    }

    /**
     * SMS Traffic Password defined in config
     * @return string
     */
    public function getPassword()
    {
        return $this->config[self::PARAM_PASSWORD];
    }

    /**
     * SMS Traffic Originator defined in config
     * @return string
     */
    public function getOriginator()
    {
        return $this->config[self::PARAM_ORIGINATOR];
    }

    /**
     * SMS Traffic Client class
     * @return string
     */
    public function getClientClass()
    {
        return $this->config[self::PARAM_CLIENT_CLASS];
    }

    /**
     * Sms Traffic API URL
     * @return string
     */
    public function getApiUrl()
    {
        return isset($this->config[self::PARAM_API_URL]) ? $this->config[self::PARAM_API_URL] : null;
    }
}
