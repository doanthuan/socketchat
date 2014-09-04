<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (Schema::hasTable('chat_users'))
        {
            //  do nothing
        }
        else
        {
            Schema::create('chat_users', function(Blueprint $table)
            {
                $table->increments('user_id');

                $table->string('name', 32);
                $table->string('gender', 10);
                $table->string('email', 320);

                $table->timestamps();
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('users');
	}

}
