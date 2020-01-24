<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:view {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for create a new view';

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
        $view = $this->argument('view');
        $path = $this->viewPath($view);
        $this->createDir($path);

        if (\File::exists($path)){
            $this->error("View: {$path} already exists!");
            return;
        }

        \File::put($path, $path);
        $this->info("View: {$path} was successfully created.");
    }

     /**
     * Get the view full path.
     *
     * @param string $view
     *
     * @return string
     */
    public function viewPath($view){
        $view = str_replace('.', '/', $view) . '.blade.php';
        $path = "resources/views/{$view}";
        return $path;
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);
        if (!file_exists($dir)){
            mkdir($dir, 0777, true);
        }
    }
}
