<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class WelcomeController extends Controller
{
    public function index()
    {
        // return view('welcome');
        $storage = Redis::connection();

        $popular = $storage->zRevRange('articleViews',0,-1); // Mengembalikan rentang elemen yang ditentukan dalam set diurutkan yang disimpan di key. Elemen-elemen dianggap dipesan dari skor tertinggi ke terendah. Hampir sama dengan zRange namun saat dicoba di terminal hasilnya kebalikannya
        foreach($popular as $value):
            $id = str_replace('article:','', $value); // fungsi str_replace () menggantikan beberapa karakter dengan beberapa karakter lain dalam sebuah string.
            echo "Article ".$id." is popular<br>";
        endforeach;
    }
}
