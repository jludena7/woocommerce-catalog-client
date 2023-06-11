<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Test\Config\Logger;
use Test\Config\SetConfig;
use WcCatalog\Services\Catalog\ProductService;

class ProductTest extends TestCase
{
    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $config = SetConfig::getConfig();
        $logger = new Logger();
        $this->productService = new ProductService($config, $logger);

        parent::__construct();
    }

    private function getCreateRequest($category, $productTag)
    {
        return [
            'sku' => 'PR-SIMPLE-' . time(),
            'name' => 'Premium Quality ' . time(),
            'type' => 'simple',
            'regular_price' => '21.99',
            'stock_quantity' => 10,
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
            'categories' => [
                [
                    'id' => $category->id,
                ],
            ],
            'tags' => [
                [
                    'id' => $productTag->id,
                ],
            ],
            'images' => [
                [
                    'src' => 'http://wordpress621.localhost/wp-content/uploads/2023/05/woo-commerce-test-1-1-150x150.webp',
                    'position' => 0
                ],
                [
                    'src' => 'http://wordpress621.localhost/wp-content/uploads/2023/05/woo-commerce-test-1-1-150x150.webp',
                    'position' => 1
                ],
            ],
        ];
    }

    /**
     * @group create_product
     * @group get_product
     * @group all_product
     * @group update_product
     * @group delete_product
     * @group get_by_sku
     * @group update_stock
     * @return mixed
     */
    public function testCreateProduct()
    {
        $category = (new CategoryTest())->testCreateCategory();
        $productTag = (new ProductTagTest)->testCreateProductTag();

        $data = $this->getCreateRequest($category, $productTag);

        $response = $this->productService->create($data);
        $this->assertTrue(isset($response->id));

        return $response;
    }

    /**
     *
     * @group get_product
     * @depends testCreateProduct
     * @param $product
     * @return mixed
     */
    public function testGetProduct($product)
    {
        $response = $this->productService->get($product->id);
        $this->assertTrue(isset($response->id));

        return $product;
    }

    /**
     * @group all_product
     * @return void
     */
    public function testAllProduct()
    {
        $response = $this->productService->all();
        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @group update_product
     * @depends testCreateProduct
     * @param $product
     * @return mixed
     */
    public function testUpdateProduct($product)
    {
        $data = [
            'name' => 'Premium Quality ' . time(),
            'type' => 'simple',
            'regular_price' => '21.99',
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
            'images' => [
                [
                    'src' => 'http://wordpress621.localhost/wp-content/uploads/2023/05/woo-commerce-test-1-1-150x150.webp',
                    'position' => 0
                ],
                [
                    'src' => 'http://wordpress621.localhost/wp-content/uploads/2023/05/woo-commerce-test-1-1-150x150.webp',
                    'position' => 1
                ],
            ],
        ];

        $response = $this->productService->update($product->id, $data);
        $this->assertIsNumeric($response->id);

        return $product;
    }

    /**
     * @group get_by_sku
     * @depends testCreateProduct
     * @param $product
     * @return void
     */
    public function testGetBySku($product)
    {
        $response = $this->productService->getBySku($product->sku);
        $this->assertIsNumeric($response[0]->id);
    }

    /**
     * @group update_stock
     * @depends testCreateProduct
     * @param $product
     * @return void
     */
    public function testUpdateStock($product)
    {
        $response = $this->productService->updateStock($product->id, 10);
        $this->assertIsNumeric($response->id);
    }

    /**
     * @group delete_product
     * @depends testCreateProduct
     * @param $product
     * @return void
     */
    public function testDeleteProduct($product)
    {
        $data = ['force' => true];
        $response = $this->productService->delete($product->id, $data);
        $this->assertIsNumeric($response->id);

        if (!empty($product->categories)) {
            foreach ($product->categories as $category) {
                (new CategoryTest())->testDeleteCategory($category);
            }
        }

        if (!empty($product->tags)) {
            foreach ($product->tags as $tag) {
                (new ProductTagTest())->testDeleteProductTag($tag);
            }
        }
    }

    public function createProductForVariation()
    {
        $category = (new CategoryTest())->testCreateCategory();
        $productTag = (new ProductTagTest)->testCreateProductTag();
        $responseParam = (new ProductAttributeTermTest)->testCreateProductAttributeTerm();

        $data = $this->getCreateRequest($category, $productTag);

        $data['sku'] = 'PR-VARIABLE-1-' . time();
        $data['type'] = 'variable';
        $data['attributes'] = [
            [
                'id' => $responseParam->productAttribute->id,
                'name' => $responseParam->productAttribute->name,
                'position' => 1,
                'visible' => true,
                'variation' => true,
                'options' => [
                    $responseParam->productAttributeTerm->name,
                ],
            ],
        ];

        $responseParam->product = $this->productService->create($data);

        return $responseParam;
    }
}
