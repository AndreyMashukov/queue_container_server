<?php

use \Illuminate\Database\Migrations\Migration;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
    {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	    {
		if (Schema::hasTable('data') === false)
		    {
			Schema::create('data', function (Blueprint $table)
			    {
				$table->increments('id')->unique();
				$table->char('hash', 32)->index();
				$table->timestamps();
			    }
			);

			\DB::statement("ALTER TABLE `data` ADD `data` LONGBLOB");
		    }
	    } //end up()


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down()
	    {
		Schema::dropIfExists('data');
	    } //end down()


    }

?>
