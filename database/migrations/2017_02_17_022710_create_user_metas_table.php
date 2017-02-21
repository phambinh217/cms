<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserMetasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_metas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('key', 100);
			$table->text('value')->nullable();
			$table->integer('order')->default(0);
			$table->string('type', 20);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_metas');
	}

}
