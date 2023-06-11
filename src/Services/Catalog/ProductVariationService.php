<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Services\BaseService;


class ProductVariationService extends BaseService
{
    /**
     * @var string
     */
    protected $uri = 'wp-json/wc/v3/products/%s/variations';

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
