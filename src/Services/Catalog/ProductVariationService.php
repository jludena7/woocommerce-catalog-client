<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Helpers\Config;
use WcCatalog\Services\CallTrait;

class ProductVariationService
{
    use CallTrait;

    /**
     * @var string
     */
    protected $uri = 'wp-json/wc/v3/products/%s/variations';

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

    public function create($productId, $data)
    {
        $uri = sprintf($this->uri, $productId);
        return $this->callCreate($uri, $data);
    }

    public function get($productId, $id)
    {
        $uri = sprintf($this->uri, $productId);
        return $this->callGet("$uri/$id");
    }

    public function all($productId)
    {
        $uri = sprintf($this->uri, $productId);
        return $this->callGet($uri);
    }

    public function update($productId, $id, $data)
    {
        $uri = sprintf($this->uri, $productId);
        return $this->callUpdate("$uri/$id", $data);
    }

    public function delete($productId, $id, $data)
    {
        $uri = sprintf($this->uri, $productId);
        return $this->callDelete("$uri/$id", $data);
    }
}
