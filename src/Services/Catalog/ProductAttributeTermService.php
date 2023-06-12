<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Helpers\Config;
use WcCatalog\Services\CallTrait;

class ProductAttributeTermService
{
    use CallTrait;

    protected $uri = 'wp-json/wc/v3/products/attributes/%s/terms';

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

    public function create($productAttributeId, $data)
    {
        $uri = sprintf($this->uri, $productAttributeId);
        return $this->callCreate($uri, $data);
    }

    public function get($productAttributeId, $id)
    {
        $uri = sprintf($this->uri, $productAttributeId);
        return $this->callGet("$uri/$id");
    }

    public function all($productAttributeId)
    {
        $uri = sprintf($this->uri, $productAttributeId);
        return $this->callGet($uri);
    }

    public function update($productAttributeId, $id, $data)
    {
        $uri = sprintf($this->uri, $productAttributeId);
        return $this->callUpdate("$uri/$id", $data);
    }

    public function delete($productAttributeId, $id, $data)
    {
        $uri = sprintf($this->uri, $productAttributeId);
        return $this->callDelete("$uri/$id", $data);
    }
}
