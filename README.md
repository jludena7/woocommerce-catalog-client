WooCommerce REST API PHP Client
=======================================

## About


## Getting started

You need to generate your WooCommerce REST API credentials (Consumer Key & Consumer Secret)

## Library configuration

### Create Object
```php

use WcCatalog\Services\Catalog\ProductService;
use WcCatalog\Helpers\Config;

$config = new Config([
    'api_url_woocommerce' => '<<YOUR_URL>>',
    'api_key_woocommerce' => '<<YOUR_API_KEY>>',
    'api_secret_woocommerce' => '<<YOUR_API_SECRET>>',
]);
$logger = <<ANY_lOGGER_LIBRARY>>
$productService = new ProductService($config, $logger);

$productService->create(<<REQUEST>>);
$productService->update($id, <<REQUEST>>);
$productService->get($id);
$productService->all();
$productService->delete($id, <<REQUEST>>);

```