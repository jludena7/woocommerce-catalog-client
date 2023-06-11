<?php

namespace WcCatalog\Services\Catalog;

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
}
