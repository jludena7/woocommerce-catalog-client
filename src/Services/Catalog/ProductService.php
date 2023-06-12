<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Helpers\Config;
use WcCatalog\Services\CallTrait;
use WcCatalog\Services\ServiceTrait;

class ProductService
{
    use CallTrait;
    use ServiceTrait;

    /**
     * @var string
     */
    protected $uri = 'wp-json/wc/v3/products';

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

    public function getBySku($sku)
    {
        return $this->callGet("$this->uri?sku=" . urldecode($sku));
    }

    public function updateStock($id, $stock)
    {
        $data = ['stock_quantity' => $stock];
        return $this->callUpdate("$this->uri/$id", $data);
    }
}
