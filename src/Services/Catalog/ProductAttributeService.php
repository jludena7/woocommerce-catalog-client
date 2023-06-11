<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Services\CallTrait;
use WcCatalog\Services\ServiceTrait;

class ProductAttributeService
{
    use CallTrait;
    use ServiceTrait;

    protected $uri = 'wp-json/wc/v3/products/attributes';
}
