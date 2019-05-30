<?php

use Illuminate\Database\Seeder;

class CrudSeed extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
    public function run()
    {
        factory('App\Model\Crud',530)->create()->each(function(){
        	
        });
    }
}
