<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLevelsTable extends Migration {

	public function up()
	{
		Schema::create('Levels', function(Blueprint $table) {
			$table->increments('id');
            $table->string('Level_Name')->unique();
            $table->text('Notes')->nullable();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('Levels');
	}
}
