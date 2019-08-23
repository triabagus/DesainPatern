<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Desain Patern LARAVEL 5.8

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1400 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

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
~~
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
