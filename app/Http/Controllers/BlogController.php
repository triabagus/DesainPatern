<?php
/**
 * Created by Tria Bagus.
 * User: topx
 * Date: 23.08.19
 * Time: 09:01
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $blog = null;
    /**
     * Repository interface Blog
     * 
     * @return \App\Repositories\BlogRepository
     */
    public function __construct(BlogRepository $blog)
    {
        $this->blog = $blog;
    }
    /**
     * Display a listing of the resource with Cache.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Cache::remember('blogs',60, function(){
                    return $this->blog->DataAllPDF();  
                });             
        return view('blogs.blog', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($blog)
    {
        $blogs = Cache::remember('blogs-'.$blog,60, function()use($blog){
                    return $this->blog->getById($blog);
                });
        return view('blogs.single-blog', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
