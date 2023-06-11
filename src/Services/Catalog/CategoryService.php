<?php

namespace WcCatalog\Services\Catalog;

use WcCatalog\Services\BaseService;
use WcCatalog\Services\ServiceTrait;

class CategoryService extends BaseService
{
    use ServiceTrait;

    /**
     * @var string
     */
    protected $uri = 'wp-json/wc/v3/products/categories';
}
