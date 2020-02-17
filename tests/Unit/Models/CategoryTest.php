<?php

namespace AppTest\Unit\Models;

use AppTest\BaseCase;
use AppTest\Traits\Database;
use App\Models\Category;

class CategoryTest extends BaseCase
{
    use Database;

    private $properties = [
        "name" => "men watches",
        "slug" => "men-watches"
    ];

    /**
     * Create and return new Category Instance
     *
     * @param array $items
     * @return Category
     */
    public function makeCategory($items = [])
    {
        return Category::create($this->items($items));
    }

    /**
     * Merge properties
     *
     * @param array $items
     * @return array
     */
    private function items($items = [])
    {
        if (empty($items)) {
            return $this->properties;
        }
        return array_merge($this->properties, $items);
    }

    public function testCanCreateAndFindNewCategory()
    {
        $this->makeCategory();
        $category = Category::find(1);
        $items = $this->items();
        $this->assertInstanceOf(
            Category::class,
            $category,
            "Category:find did not return instance of Category"
        );

        $this->assertEquals(
            $items['name'],
            $category->name,
            "Category::create did not add record with the correct name"
        );
        $this->assertEquals(
            $items['slug'],
            $category->slug,
            "Category::create did not add record with the correct slug"
        );
    }
}
