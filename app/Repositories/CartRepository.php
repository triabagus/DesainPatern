<?php
/**
 * Created by Tria Bagus.
 * User: topx
 * Date: 09.07.19
 * Time: 14:47
 */
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartRepository implements MyInterface
{
    private $model;

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }
    /**
     * Get all Products
     *
     * @return Models\Product
     */
    public function getAll()
    {

    }
    /**
     * Get Product by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {

    }
    /**
     * Create new Product
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

    }
    /**
     * Update Product by id
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id,array $attributes)
    {

    }
    /**
     * Delete Product by id
     *
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        // hapus file
    }

    function deleteImageExpired($attributes){
        
    }

    function allData(){
        
    }
}