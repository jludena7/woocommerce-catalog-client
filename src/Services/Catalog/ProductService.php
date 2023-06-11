<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Services\BaseService;
use WcCatalog\Services\ServiceTrait;

class ProductService extends BaseService
{
    use ServiceTrait;

    /**
     * @var string
     */
    protected $uri = 'wp-json/wc/v3/products';

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
