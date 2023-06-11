<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Test\Config\Logger;
use Test\Config\SetConfig;
use WcCatalog\Services\Catalog\ProductAttributeService;

class ProductAttributeTest extends TestCase
{
    /**
     * @var ProductAttributeService
     */
    private $productAttributeService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $config = SetConfig::getConfig();
        $logger = new Logger();
        $this->productAttributeService = new ProductAttributeService($config, $logger);

        parent::__construct();
    }

    /**
     * @group create_product_attribute
     * @group get_product_attribute
     * @group all_product_attribute
     * @group update_product_attribute
     * @group delete_product_attribute
     * @return mixed
     */
    public function testCreateProductAttribute()
    {
        $data = [
            'name' => 'Color ' . time(),
            'slug' => 'color-' . time(),
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ];

        $response = $this->productAttributeService->create($data);
        $this->assertTrue(isset($response->id));

        return $response;
    }

    /**
     *
     * @group get_product_attribute
     * @depends testCreateProductAttribute
     * @param $productAttribute
     * @return mixed
     */
    public function testGetProductAttribute($productAttribute)
    {
        $response = $this->productAttributeService->get($productAttribute->id);
        $this->assertIsNumeric($response->id);

        return $productAttribute;
    }

    /**
     * @group all_product_attribute
     * @return void
     */
    public function testAllProductAttribute()
    {
        $response = $this->productAttributeService->all();
        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @group update_product_attribute
     * @depends testCreateProductAttribute
     * @param $productAttribute
     * @return mixed
     */
    public function testUpdateProductAttribute($productAttribute)
    {
        $data = [
            'name' => 'Color ' . time(),
            'slug' => 'color-' . time(),
            'type' => 'select',
            'order_by' => 'menu_order',
            'has_archives' => true,
        ];

        $response = $this->productAttributeService->update($productAttribute->id, $data);
        $this->assertTrue(isset($response->id));

        return $productAttribute;
    }

    /**
     * @group delete_product_attribute
     * @depends testCreateProductAttribute
     * @param $productAttribute
     * @return void
     */
    public function testDeleteProductAttribute($productAttribute)
    {
        $data = ['force' => true];
        $response = $this->productAttributeService->delete($productAttribute->id, $data);
        $this->assertTrue(isset($response->id));
    }
}
