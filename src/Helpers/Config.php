<?php

namespace WcCatalog\Helpers;

use Exception;

class Config
{
    private $apiUrlWooCommerce;

    private $apiKeyWooCommerce;

    private $apiSecretWooCommerce;

    private $onlyOAuth;

    /**
     * @param array $config
     * @throws Exception
     */
    public function __construct($config)
    {
        if (empty($config['api_url_woocommerce'])) {
            throw new Exception('Is empty api_url_woocommerce');
        }

        $this->apiUrlWooCommerce = $config['api_url_woocommerce'];
        $this->apiKeyWooCommerce = $config['api_key_woocommerce'];
        $this->apiSecretWooCommerce = $config['api_secret_woocommerce'];
        $this->onlyOAuth = isset($config['only_oauth']) && $config['only_oauth'];
    }

    /**
     * @return string
     */
    public function getApiUrlWooCommerce()
    {
        return rtrim($this->apiUrlWooCommerce, '/') . '/';
    }

    /**
     * @return string
     */
    public function getApiKeyWooCommerce()
    {
        return $this->apiKeyWooCommerce;
    }

    /**
     * @return string
     */
    public function getApiSecretWooCommerce()
    {
        return $this->apiSecretWooCommerce;
    }

    /**
     * @return bool
     */
    public function getOnlyOAuth()
    {
        return $this->onlyOAuth;
    }
}
