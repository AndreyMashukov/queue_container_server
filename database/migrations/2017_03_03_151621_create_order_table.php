<?php

use \Illuminate\Database\Migrations\Migration;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
    {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	    {
		if (Schema::hasTable('order') === false)
		    {
			Schema::create('order', function (Blueprint $table)
			    {
				$table->increments('id')->unique();
				$table->char('hash', 32);
				$table->char('container_name', 32)->index();
				$table->string('readable_container_name');
				$table->timestamps();
			    }
			);
		    }
	    } //end up()


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	public function down()
	    {
		Schema::dropIfExists('order');
	    } //end down()


    }

?>
