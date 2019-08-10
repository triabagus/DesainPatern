<?php
/**
 * Created by Tria Bagus.
 * User: topx
 * Date: 09.07.19
 * Time: 14:47
 */
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Product;
use File;

class ProductRepository implements MyInterface
{
    private $model;

    public function __construct(Product $model)
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

    public function DataAllPDF()
    {
        return $this->model->all();
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
        // hapus file
        $gambar = $this->model->where('id',$id)->first();
        File::delete('image-product/'.$gambar->image_product);

        return $this->model->find($id)->delete();
    }

    public function deleteImageExpired($attributes){
        File::delete('image-product/'.$attributes);
    }

}