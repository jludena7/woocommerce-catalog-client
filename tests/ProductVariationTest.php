<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Test\Config\Logger;
use Test\Config\SetConfig;
use WcCatalog\Services\Catalog\ProductVariationService;

class ProductVariationTest extends TestCase
{
    /**
     * @var ProductVariationService
     */
    private $productVariationService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $config = SetConfig::getConfig();
        $logger = new Logger();
        $this->productVariationService = new ProductVariationService($config, $logger);

        parent::__construct();
    }

    /**
     * @group create_product_variation
     * @group get_product_variation
     * @group all_product_variation
     * @group update_product_variation
     * @group delete_product_variation
     * @return object
     */
    public function testCreateProductVariation()
    {
        $responseParam = (new ProductTest)->createProductForVariation();

        $data = [
            'sku' => 'PR-VARIABLE-2-' . time(),
            'regular_price' => '24',
            'sale_price' => '21',
            'image' => [
                'id' => $responseParam->product->images[0]->id,
            ],
            'attributes' => [
                [
                    'id' => $responseParam->productAttribute->id,
                    'option' => $responseParam->productAttributeTerm->name,
                ],
            ],
        ];

        $response = $this->productVariationService->create($responseParam->product->id, $data);
        $this->assertTrue(isset($response->id));

        $responseParam->productVariation = $response;

        return $responseParam;
    }

    /**
     *
     * @group get_product_variation
     * @depends testCreateProductVariation
     * @param $responseParam
     * @return mixed
     */
    public function testGetProductVariation($responseParam)
    {
        $response = $this->productVariationService->get(
            $responseParam->product->id,
            $responseParam->productVariation->id
        );
        $this->assertTrue(isset($response->id));

        return $responseParam;
    }

    /**
     * @group all_product_variation
     * @depends testCreateProductVariation
     * @param $responseParam
     * @return void
     */
    public function testAllProductVariation($responseParam)
    {
        $response = $this->productVariationService->all($responseParam->product->id);
        $this->assertGreaterThan(0, count($response));
    }

    /**
     * @group update_product_variation
     * @depends testCreateProductVariation
     * @param $responseParam
     * @return mixed
     */
    public function testUpdateProductVariation($responseParam)
    {
        $data = [
            'sku' => 'PR-VARIABLE-2-' . time(),
            'regular_price' => '24',
            'sale_price' => '21',
            'image' => [
                'id' => $responseParam->product->images[0]->id,
            ],
            'attributes' => [
                [
                    'id' => $responseParam->productAttribute->id,
                    'option' => $responseParam->productAttributeTerm->name,
                ],
            ],
        ];

        $response = $this->productVariationService->update(
            $responseParam->product->id,
            $responseParam->productVariation->id,
            $data
        );
        $this->assertTrue(isset($response->id));

        return $responseParam;
    }

    /**
     * @group delete_product_variation
     * @depends testCreateProductVariation
     * @param $responseParam
     * @return void
     */
    public function testDeleteProductVariation($responseParam)
    {
        $data = ['force' => true];
        $response = $this->productVariationService->delete(
            $responseParam->product->id,
            $responseParam->productVariation->id,
            $data
        );

        (new ProductTest)->testDeleteProduct($responseParam->product);

        $this->assertTrue(isset($response->id));
    }
}
