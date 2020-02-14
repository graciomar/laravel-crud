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
        $this->createViews($crud, 'create');
        $this->createRoutes($crud);
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
        $codigo = str_ireplace("#crud", ucfirst($crud), $codigo);
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
| Routes for posts
|--------------------------------------------------------------------------
*/
Route::name('{$crud1}.')->prefix('posts')->group(function () {
    Route::get('/', '{$crud2}ControllerAPI@index')->name('index');
    Route::post('/', '{$crud2}ControllerAPI@store')->name('create');
    Route::get('/{id}', '{$crud2}ControllerAPI@show')->name('show');
    Route::patch('/{id}', '{$crud2}ControllerAPI@update')->name('update');
    Route::delete('/{id}', '{$crud2}ControllerAPI@destroy')->name('destroy');
});";
        $codigo = $codigo.$routes;
        \File::put($arquivo, $codigo);
    }

}
