<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showArticle($id)
    {
        $this->id = $id;
        $storage = Redis::connection();
        
        if($storage->zScore('articleViews', 'article:'. $id)): // if key null
            $storage->pipeline(function($pipe){ // pipeline for many send perintah ke server dalam satu operasi
                $pipe->ZincrBy('articleViews',1,'article:'. $this->id); // add score urutan article
                $pipe->incr('article:'. $this->id .':views');
            });
        else:
            $views = $storage->incr('article:'. $this->id .':views'); // incr for increment id with redis
            $storage->ZincrBy('articleViews',1,'article:'. $this->id); // add score urutan article
        endif;

        $views = $storage->get('article:'.$this->id.':views');
        return "This is article with id:". $id ." it has ". $views ." views";
    }
}
