<?php

namespace Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Test\Config\Logger;
use Test\Config\SetConfig;
use WcCatalog\Services\Catalog\CategoryService;

class CategoryTest extends TestCase
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $config = SetConfig::getConfig();
        $logger = new Logger();
        $this->categoryService = new CategoryService($config, $logger);

        parent::__construct();
    }

    /**
     * @group create_category
     * @group get_category
     * @group all_category
     * @group update_category
     * @group delete_category
     * @return mixed
     */
    public function testCreateCategory()
    {
        $data = [
            'name' => 'Clothing ' . time(), //Mandatory
            'slug' => 'clothing-' . time(),
            'description' => 'clothing description' . time(),
            'image' => [
                'src' => 'http://wordpress621.localhost/wp-content/uploads/2023/05/woo-commerce-test-1-1-150x150.webp',
            ],
        ];

        $response = $this->categoryService->create($data);
        $this->assertTrue(isset($response->id));

        return $response;
    }

    /**
     *
     * @group get_category
     * @depends testCreateCategory
     * @param $category
     * @return mixed
     */
    public function testGetCategory($category)
    {
        $response = $this->categoryService->get($category->id);
        $this->assertTrue(isset($response->id));

        return $category;
    }

    /**
     * @group all_category
     * @return void
     */
    public function testAllCategory()
    {
        $response = $this->categoryService->all();
        $this->assertGreaterThan(0, count($response));
    }

    /**
     *
     * @group update_category
     * @depends testCreateCategory
     * @param $category
     * @return mixed
     */
    public function testUpdateCategory($category)
    {
        $data = [
            'name' => 'Clothing ' . time(), //Mandatory
            'slug' => 'clothing-' . time(),
            'description' => 'clothing description' . time(),
            'image' => [
                'src' => 'http://wordpress621.localhost/wp-content/uploads/2023/05/woo-commerce-test-1-1-150x150.webp',
            ],
        ];

        $response = $this->categoryService->update($category->id, $data);
        $this->assertTrue(isset($response->id));

        return $category;
    }

    /**
     * @group delete_category
     * @depends testCreateCategory
     * @param $category
     * @return void
     */
    public function testDeleteCategory($category)
    {
        $data = ['force' => true];
        $response = $this->categoryService->delete($category->id, $data);
        $this->assertTrue(isset($response->id));
    }
}
