<?php

namespace Tests\Feature\Edu;

use App\Models\Journal;
use App\Models\Product;
use Tests\Feature\BaseTestCase;

class ProductTest extends BaseTestCase
{
    public function test_product_relations(): void
    {
        $product = Product::find(1);
        $this->assertNotNull($product);

        $this->assertEquals($product->author->id, 1);
        $this->assertCount(4, $product->courses);
    }
}
