<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Test\Config\Logger;
use Test\Config\SetConfig;
use WcCatalog\Services\Catalog\ProductAttributeTermService;

class ProductAttributeTermTest extends TestCase
{
    /**
     * @var ProductAttributeTermService
     */
    private $productAttributeTermService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $config = SetConfig::getConfig();
        $logger = new Logger();
        $this->productAttributeTermService = new ProductAttributeTermService(
            $config,
            $logger
        );

        parent::__construct();
    }

    /**
     * @group create_product_attribute_term
     * @group get_product_attribute_term
     * @group all_product_attribute_term
     * @group update_product_attribute_term
     * @group delete_product_attribute_term
     * @return object
     */
    public function testCreateProductAttributeTerm()
    {
        $productAttribute = (new ProductAttributeTest)->testCreateProductAttribute();

        $data = [
            'name' => 'Blue ' . time(),
            'slug' => 'blue-' . time(),
        ];

        $response = $this->productAttributeTermService->create(
            $productAttribute->id,
            $data
        );
        $this->assertTrue(isset($response->id));

        return (object) [
            'productAttributeTerm' => $response,
            'productAttribute' => $productAttribute,
        ];
    }

    /**
     *
     * @group get_product_attribute_term
     * @depends testCreateProductAttributeTerm
     * @param $responseParam
     * @return mixed
     */
    public function testGetProductAttributeTerm($responseParam)
    {
        $response = $this->productAttributeTermService->get(
            $responseParam->productAttribute->id,
            $responseParam->productAttributeTerm->id
        );
        $this->assertTrue(isset($response->id));

        return $responseParam;
    }

    /**
     * @group all_product_attribute_term
     * @depends testCreateProductAttributeTerm
     * @param $responseParam
     * @return void
     */
    public function testAllProductAttributeTerm($responseParam)
    {
        $response = $this->productAttributeTermService->all(
            $responseParam->productAttribute->id
        );
        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @group update_product_attribute_term
     * @depends testCreateProductAttributeTerm
     * @param $responseParam
     * @return mixed
     */
    public function testUpdateProductAttributeTerm($responseParam)
    {
        $data = [
            'name' => 'Blue ' . time(),
            'slug' => 'blue-' . time(),
        ];

        $response = $this->productAttributeTermService->update(
            $responseParam->productAttribute->id,
            $responseParam->productAttributeTerm->id,
            $data
        );
        $this->assertTrue(isset($response->id));

        return $responseParam;
    }

    /**
     * @group delete_product_attribute_term
     * @depends testCreateProductAttributeTerm
     * @param $responseParam
     * @return void
     */
    public function testDeleteProductAttributeTerm($responseParam)
    {
        $data = ['force' => true];
        $response = $this->productAttributeTermService->delete(
            $responseParam->productAttribute->id,
            $responseParam->productAttributeTerm->id,
            $data
        );

        (new ProductAttributeTest)->testDeleteProductAttribute(
            $responseParam->productAttribute
        );

        $this->assertTrue(isset($response->id));
    }
}
