<?php
/**
 * Created by Tria Bagus.
 * User: topx
 * Date: 09.07.19
 * Time: 14:47
 */
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\ProductCategories;

class CategoriesRepository implements MyInterface
{
    private $model;

    public function __construct(ProductCategories $model)
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
        return $this->model->latest()->paginate(4);
    }
    /**
     * Get Product by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }
    /**
     * Create new Product
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
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
        return $this->model->find($id)->update($attributes);
    }
    /**
     * Delete Product by id
     *
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->find($id)->delete();
    }


    function deleteImageExpired($attributes){
        
    }

    function allData(){
        return $this->model->all();
    }
}