<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class csvImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name_product'      => $row[1],
            'stock'             => $row[2],
            'price'             => $row[3],
            'image_product'     => $row[4],
            'created_at'        => $row[5],
            'updated_at'        => $row[6],
            'categories_id'     => $row[7]
        ]);
    }
}
