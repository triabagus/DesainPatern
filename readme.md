<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Desain Patern LARAVEL 5.8
    Pembelajaran :
    1. Make desain patern 
    2. Cart
    3. Role middleware
    4. Redis and cache with predis
    5. Make controller with resource
    6. Make Testing
    7. Make relasi product and category product 
## Cart
    Make cart in cartController.php
## Role Middleware
1. Make field is_admin type boolean
~~~php
$table->boolean('is_admin')->nullable();
~~~
2. Make middleware admin
~~~php
php artisan make:middleware adminRole
~~~
3. Update in function handle 
~~~php
if(auth()->user()->is_admin == 0){
    return $next($request);
}else{
    return $next($request);
}
~~~
4. Add middleware in file kernel -> http
~~~php
protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
    'can' => \Illuminate\Auth\Middleware\Authorize::class,
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'adminRole' => \App\Http\Middleware\AdminRole::class, // add
    ];
~~~
5. Setting route yang ingin di tambahakan middleware role
~~~php
    Route::get('/home', 'HomeController@index')->name('home')->middleware('adminRole');
~~~
6. Check role admin/ user
~~~php
    @if(auth()->user()->is_admin == 0)
    <a href="{{url('/admin')}}">User</a>
    @elseif(auth()->user()->is_admin == 1)
    <a href="{{url('/admin')}}">Admin</a>
    @else
    <div class=”panel-heading”>Normal User</div>
    @endif
~~~
## Redis 
Redis untuk menyimpan cache data biar mempercepat berjalannya website yang tersimpan di memory , namun perlu diketahui bahwa penggunaan redis harus diperhatikan baik baik dan perlu pengawasan karena semua data yang ke cache akan tersimpan di memory. Hal ini bisa dicegah dengan memory limit dan memory policy, dengan menggunakan memory policy kita bisa mengatur kembali atau memuncul error cache yang melebihi batas dari memory limit. Kalau tidak di beri yang terjadi akan mengakibatkan trash di memory.

1. PraSyarat
~~~php
sudo apt-get update
sudo apt-get upgrade // kalau ingin update linux, lain kali tidak usah tidak apa-apa
~~~
2. Installing Redis
Paket redis repositories
~~~php
sudo apt-get install redis-server
~~~
Next is to enable Redis to start on system boot. Also restart Redis service once
~~~php
sudo systemctl enable redis-server.service
~~~
3. Configure Redis
Download vim in ubuntu
~~~php
sudo apt install vim
sudo vim /etc/redis/redis.conf // ubah configurasi memory
~~~
update file 
~~~php
maxmemory 256mb
maxmemory-policy allkeys-lru
// for example save and update file in vim , cek in link : https://blog.taryo.net/2015/12/belajar-menggunakan-vim-via-terminal-di-linux.html
~~~
Save and configurasi file enable service 
~~~php
sudo systemctl restart redis-server.service
~~~
4. Install Redis PHP Extension
For php install extension redis
~~~php
sudo apt-get install php-redis
~~~
5. Test Connection to Redis Server
~~~php
$ redis-cli

127.0.0.1:6379> ping
PONG
127.0.0.1:6379>

// or setting redis in link : https://redis.io/commands/INFO

$ redis-cli info
$ redis-cli info stats
$ redis-cli info server
~~~

6. Predis Tutorial
Perintah dasar untuk redis in terminal
~~~php
$ redis-cli // enable redis
127.0.0.1:6379> keys * // see all keys in redis library
127.0.0.1:6379> get name_key // see value get name_key in redis library
127.0.0.1:6379> flushall // delete all keys in redis 
~~~
Install in laravel predis 
~~~php
composer require predis/predis
~~~
Delete Redis : https://tecadmin.net/delete-data-redis/ or flushall

8. Popular post redis function

Check in route web.php , Route::get('/', function () { ... }
Check in PostController , untuk set data example artikel sesuai id
Check in WelcomeController , unutk menampilkan data artikel popular
Check .env , CACHE_DRIVER=redis

7. Cache query database 

Siapkan Tampilan Blog
~~~php
$ composer require barryvdh/laravel-debugbar // untuk cek query cache berjalan atau tidak
$ php artisan migrate , blog_posts
$ php artisan make:controller BlogController -m Blog -r
$ php artisan make:seed BlogSeeder
$ php artisan db:seed , cek in DatabaseSeeder
~~~

in web.php
~~~php
Route::resource('blog', 'BlogController');  // untuk memanggil controller dengan mudah
~~~
    a. BlogController
    b. BlogRepository
    c. Blog , modal
    d. .env , CACHE_DRIVER=redis atau in cache.php
~~~php
    'default' => env('CACHE_DRIVER', 'redis'),
~~~
    e. database.php , 
~~~php
        'redis' => [

        'client' => env('REDIS_CLIENT', 'predis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'predis'),
            'prefix' => Str::slug(env('APP_NAME', 'laravel'), '_').'_database_',
        ],

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 0), // harus 0 kalau 1 nanti menyimpan tetap di file /storage/framework/cache/data/ {date} / db / file_cache
        ],

    ],
~~~
    f. make view blogs.blog
    g. waktu dalam cache redis dihitung dalam satuan detik
