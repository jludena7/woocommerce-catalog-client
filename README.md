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
### Execute unit test
- Rename file woocommerce-catalog-client\tests\Config\SetConfig.php.dist to woocommerce-catalog-client\tests\Config\SetConfig.php
- Set your WooCommerce API credentials
- Run unit test command
```
>> cd woocommerce-catalog-client
>> ./vendor/bin/phpunit tests/
>> ./vendor/bin/phpunit tests/ --group=get_by_sku
```
