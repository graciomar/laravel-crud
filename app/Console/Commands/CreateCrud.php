<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:crud {crud}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create a new crud';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $crud = $this->argument('crud');
        if (file_exists("resources/views/{$crud}")){
            $this->error("CRUD: {$crud} already exists!");
            return;
        }

        $this->createDir($crud);
        $this->createViews($crud, 'index');
        $this->createViews($crud, 'edit');
        $this->createViews($crud, 'show');
        $this->createViews($crud, 'create');
        $this->createRoutes($crud);
        $this->createModel($crud);
        $this->createController($crud);
        //$this->createMigration($crud);
        $this->info("CRUD: {$crud} was successfully created.");
    }

    /**
    * Create view directory if not exists.
    *
    * @param $path
    */
    public function createDir($path)
    {
        if (!file_exists("resources/views/{$path}")){
            mkdir("resources/views/{$path}/", 0777, true);
        }
    }

    /**
    * Create view if not exists.
    *
    * @param $crud
    * @param $crud
    */
    public function createViews($crud, $view)
    {
        $arquivo = "resources/views/{$crud}/{$view}.blade.php";
        $codigo = file_get_contents("resources/views/crud/{$view}.blade.php");
        $codigo = str_ireplace("crud", $crud, $codigo);
        if (!file_exists($arquivo)){
            \File::put($arquivo, $codigo);
        }
    }

    /**
    * Create Controller if not exists.
    *
    * @param $crud
    */
    public function createController($crud)
    {
        $arquivo = "app/Http/Controllers/".ucfirst($crud)."Controller.php";
        $codigo = file_get_contents("app/Http/Controllers/CrudController.php");
        $codigo = str_ireplace("CrudController", ucfirst($crud.'Controller'), $codigo);
        $codigo = str_ireplace("Crud", ucfirst($crud), $codigo);
        if (!file_exists($arquivo)){
            \File::put($arquivo, $codigo);
        }
    }


    /**
    * Create Migration if not exists.
    *
    * @param $crud
    */
    public function createMigration($crud)
    {
        $arquivo = "database/migrations/".$crud.".php";
        $codigo = file_get_contents("database/migrations/crud.php");
        $codigo = str_ireplace("cruds", $crud.'s', $codigo);
        $codigo = str_ireplace("class Crud", 'class '.ucfirst($crud), $codigo);
        if (!file_exists($arquivo)){
            \File::put($arquivo, $codigo);
        }
    }

    /**
    * Create Controller if not exists.
    *
    * @param $crud
    */
    public function createModel($crud)
    {
        $arquivo = "app/Model/".ucfirst($crud).".php";
        $codigo = file_get_contents("app/Model/Crud.php");
        $codigo = str_ireplace("Crud", ucfirst($crud), $codigo);
        if (!file_exists($arquivo)){
            \File::put($arquivo, $codigo);
        }
    }

    /**
    * Create group routes.
    *
    * @param $crud
    */
    public function createRoutes($crud)
    {
        $arquivo = "routes/web.php";
        $codigo = file_get_contents($arquivo);
        $crud1 = strtolower($crud);
        $crud2 = ucfirst($crud);
        $routes = "\n\n/*
|--------------------------------------------------------------------------
| Routes for {$crud1}
|--------------------------------------------------------------------------
*/
Route::name('{$crud1}.')->prefix('{$crud1}')->group(function () {
    Route::get('/index', '{$crud2}Controller@index')->name('index');
    Route::get('/create', '{$crud2}Controller@create')->name('create');
    Route::post('/store', '{$crud2}Controller@store')->name('store');
    Route::get('/show/{id}', '{$crud2}Controller@show')->name('show');
    Route::get('/edit/{id}', '{$crud2}Controller@edit')->name('edit');
    Route::post('/update', '{$crud2}Controller@update')->name('update');
    Route::delete('/destroy/{id}', '{$crud2}Controller@destroy')->name('destroy');
});";
        $codigo = $codigo.$routes;
        \File::put($arquivo, $codigo);
    }

}
