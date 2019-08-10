<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    // Categories Repository is the interface
    public function __construct(CategoriesRepository $categorisProduct)
    {
        $this->categorisProduct = $categorisProduct;
    }

    public function getAllCategory()
    {
        $title    = "Data Category";
        $categorisProduct = $this->categorisProduct->getAll();
        return view('category.data-category', ['title' => $title,'category' => $categorisProduct])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function createCategory(Request $request)
    {
        $validate   = request()->validate([
            'name_categories'  => 'required|max:100'
        ],[
            'name_categories.required' => '* Name category null',
            'name_categories.max:100' => '* Name category fully 100 character'
        ]);
        $validate   = request()->all();

        $form_data = array(
            'name_categories'        =>  $request->name_categories
        );

        $categorisProduct   = $this->categorisProduct->create($form_data);
        return back()->with('success','Add data category success');
    }

    public function getCategory($id)
    {
        $title = "Detail Category";
        $categorisProduct = $this->categorisProduct->getById($id);
        return view('category.show-category',['category' => $categorisProduct, 'title' => $title ]);
    }

    public function updateCategory(Request $request){
        
        $validate   = request()->validate([
            'name_categories'  => 'required|max:100'
        ],[
            'name_categories.required' => '* Name category null',
            'name_categories.max:100' => '* Name category fully 100 character'
        ]);
        $validate   = request()->all();

        $form_data = array(
            'name_categories'        =>  $request->name_categories
        );

        $categorisProduct   = $this->categorisProduct->update($request->id,$form_data);
        return redirect('data-category')->with('success','Update data category success');
    }

    public function deleteCategory($id)
    {
        $categorisProduct = $this->categorisProduct->delete($id);
        return back()->with('success','Delete data category success');
    }
}
