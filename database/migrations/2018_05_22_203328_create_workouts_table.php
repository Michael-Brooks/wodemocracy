<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkoutsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workouts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('details');
			$table->integer('won');
			$table->unsignedInteger('w_o_d_id');
			$table->unsignedInteger('user_id');
			$table->foreign('w_o_d_id')->references('id')->on('w_o_d_s');
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::dropIfExists('workouts');
	}
}
