<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /** @test */
    public function show_db_product_load_test(){
        // Arrage
        $product = factory('App\Models\Product')->create();
        // Act
        $response = $this->get('/data-product'); 
        // Assert
        $response->assertSee($product->nama_product);
    }

    // /** @test not good database*/
    // public function create_db_product_test(){
    //     // Arrage
    //     $product = factory('App\Models\Product')->make();
    //     // Act
    //     $this->post('/product/add',$product->toArray());
    //     // Assert
    //     $this->assertEquals(5,Product::all()->count());
    // }
    
    // https://code.tutsplus.com/id/tutorials/testing-laravel-controllers--net-31456
    
    /** @test */
    public function page_product_load()
    {
        // Arrage

        // Act
        $response = $this->get('/data-product');
        // Assert
        $response->assertStatus(200);
        $response->AssertSee('Data Product');
    }

    /** @test */
    public function added_product_test()
    {
        // Arrage
        Storage::fake('public');
        // Act
        $response = $this->post('/product/add',[
            'name_product'  =>  'First Product',
            'stock'         =>  1,
            'price'         =>  100,
            'category'      =>  1,
            'image_product' =>  $file = UploadedFile::fake()->image('image.jpg', 1, 1)
        ]);
        // Assert
        $response->assertStatus(302);
    }
}
