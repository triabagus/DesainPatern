<?php
/**
 * Created by Tria Bagus.
 * User: topx
 * Date: 09.07.19
 * Time: 14:47
 */
namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Repositories\CategoriesRepository;
use App\Http\Controllers\Controller;

use App\Exports\csvExportProduct;
use App\Imports\csvImportProduct;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ProductController extends Controller
{
    protected $product = null;
    protected $categorisProduct = null;

    // ProductRepository is the interface
    public function __construct(ProductRepository $product, CategoriesRepository $categorisProduct)
    {
        $this->product = $product;
        $this->categorisProduct = $categorisProduct;
    }
    /**
     * Display a listing a resource
     * 
     * @return Illuminate\Http\Response
     */
    public function getAllProducts()
    {
        $title    = "Data Product";
        $products = $this->product->getAll();
        $categorisProduct = $this->categorisProduct->allData();
        return view('product.data-product', ['products' => $products ,'title' => $title,'category' => $categorisProduct])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function createProducts(Request $request)
    {
        $validate   = request()->validate([
            'name_product'  => 'required|max:100',
            'stock'         => 'required|integer',
            'price'         => 'required|integer',
            'category'      => 'required|integer',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'stock.integer' => '* Stock is a number',
            'price.integer' => '* Price is a number',
            'category.required' => '* Select your category product',
            'image_product.mimes' => '* File must be jpeg,png,jpg,gif or svg',
            'image_product.max' => '* File exceeds 2 Mb'
        ]);
        $validate   = request()->all();

        $image = $request->file('image_product');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('image-product'), $new_name);
        
        $form_data = array(
            'name_product'        =>  $request->name_product,
            'stock'               =>  $request->stock,
            'price'               =>  $request->price,
            'image_product'       =>  $new_name,
            'categories_id'       =>  $request->category,
        );

        $products   = $this->product->create($form_data);
        return back()->with('success','Add data product success');
    }
    
    public function getProducts($id)
    {
        $title = "Detail Product";
        $products = $this->product->getById($id);
        $categorisProduct = $this->categorisProduct->getAll();
        return view('product.show-product',['products' => $products, 'title' => $title , 'category' => $categorisProduct]);
    }

    public function updateProducts(Request $request){
        $new_name   = $request->hidden_image;
        $image      = $request->file('image_product');

        if($image != '')
        {
            $validate   = request()->validate([
                'name_product'  => 'required|max:100',
                'stock'         => 'required|integer',
                'price'         => 'required|integer',
                'category' => 'required|integer',
                'image_product' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],[
                'stock.integer' => '* Stock is a number',
                'price.integer' => '* Price is a number',
                'category.required' => '* Select your category product',
                'image_product.mimes' => '* File must be jpeg,png,jpg,gif or svg',
                'image_product.max' => '* File exceeds 2 Mb'
            ]);
            $validate   = request()->all();
            
            if($new_name != "default.png"){
                $products = $this->product->deleteImageExpired($new_name);
            }
            
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image-product'), $new_name);
        }else {
            $validate   = request()->validate([
                'name_product'  => 'required|max:100',
                'stock'         => 'required|integer',
                'price'         => 'required|integer',
                'category' => 'required|integer',
            ],[
                'stock.integer' => '* Stock is a number',
                'price.integer' => '* Price is a number',
                'category.required' => '* Select your category product',
            ]);
            $validate   = request()->all();

        }

        $form_data = array(
            'name_product'        =>  $request->name_product,
            'stock'               =>  $request->stock,
            'price'               =>  $request->price,
            'image_product'       =>  $new_name,
            'categories_id'       =>  $request->category,
        );
        $products   = $this->product->update($request->id,$form_data);
        return redirect('data-product')->with('success','Update data product success');
    }

    public function deleteProducts($id)
    {
        $products = $this->product->delete($id);
        return back()->with('success','Delete data product success');
    }

    public function export_excel()
    {
        return Excel::download(new csvExportProduct, 'product.xlsx');
    }

    public function import_excel(Request $request)
    {
        //validate
        $this->validate($request,[
            'file'      => 'required|mimes:csv,xls,xlsx'
        ]);

        //menangkap file import
        $file = $request->file('file');

        //membuat nama file unik
        $nama_file = rand().$file->getClientOriginalName();

        //upload file excel in public
        $file->move('file-excel', $nama_file);

        //import data
        Excel::import(new csvImportProduct, public_path('/file-excel/'.$nama_file));

        return back()->with('success','Import data success');
    }

    public function pdf()
    {
        $products = $this->product->DataAllPDF();
        $pdf = PDF::loadview('pdf.product_pdf',['product' => $products]);
        // return $pdf->download('product-pdf');  //kalau ingin langsung di download
        return $pdf->stream();
    }
}
