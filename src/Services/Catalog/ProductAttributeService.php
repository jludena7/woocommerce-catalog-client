<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Services\BaseService;
use WcCatalog\Services\ServiceTrait;

class ProductAttributeService extends BaseService
{
    use ServiceTrait;

    protected $uri = 'wp-json/wc/v3/products/attributes';
}
