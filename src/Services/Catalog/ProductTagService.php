<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Helpers\Config;
use WcCatalog\Services\CallTrait;
use WcCatalog\Services\ServiceTrait;

class ProductTagService
{
    use CallTrait;
    use ServiceTrait;

    /**
     * @var string
     */
    protected $uri = 'wp-json/wc/v3/products/tags';

    /**
     * @var Config
     */
    protected $config;

    protected $logger;

    /**
     * @param Config $config
     * @param $logger
     */
    public function __construct($config, $logger)
    {
        $this->config = $config;
        $this->logger = $logger;
    }
}
