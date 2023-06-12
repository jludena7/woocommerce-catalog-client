<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Test\Config\Logger;
use Test\Config\SetConfig;
use WcCatalog\Services\Catalog\ProductTagService;

class ProductTagTest extends TestCase
{
    /**
     * @var ProductTagService
     */
    private $productTagService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $config = SetConfig::getConfig();
        $logger = new Logger();
        $this->productTagService = new ProductTagService($config, $logger);
        parent::__construct();
    }

    /**
     * @group create_product_tag
     * @group get_product_tag
     * @group update_product_tag
     * @group delete_product_tag
     * @group all_product_tag
     * @return mixed
     */
    public function testCreateProductTag()
    {
        $data = [
            'name' => 'Leather ' . time(),
            'slug' => 'leather-' . time(),
            'description' => 'Leather description ' . time(),
        ];

        $response = $this->productTagService->create($data);
        $this->assertTrue(isset($response->id));

        return $response;
    }

    /**
     *
     * @group get_product_tag
     * @depends testCreateProductTag
     * @param $productTag
     * @return mixed
     */
    public function testGetProductTag($productTag)
    {
        $response = $this->productTagService->get($productTag->id);
        $this->assertTrue(isset($response->id));

        return $productTag;
    }

    /**
     * @group all_product_tag
     * @return void
     */
    public function testAllProductTag()
    {
        $response = $this->productTagService->all();
        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @group update_product_tag
     * @depends testCreateProductTag
     * @param $productTag
     * @return mixed
     */
    public function testUpdateProductTag($productTag)
    {
        $data = [
            'name' => 'Leather ' . time(),
            'slug' => 'leather-' . time(),
            'description' => 'Leather description ' . time(),
        ];

        $response = $this->productTagService->update($productTag->id, $data);
        $this->assertTrue(isset($response->id));

        return $productTag;
    }

    /**
     * @group delete_product_tag
     * @depends testCreateProductTag
     * @param $productTag
     * @return void
     */
    public function testDeleteProductTag($productTag)
    {
        $data = ['force' => true];
        $response = $this->productTagService->delete($productTag->id, $data);
        $this->assertTrue(isset($response->id));
    }
}
