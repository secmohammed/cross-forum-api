<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('posts', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('topic_id')->unsigned()->index();
			$table->integer('parent_id')->unsigned()->index()->nullable();
			$table->text('body');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('topic_id')->references('id')->on('topics');
			$table->foreign('parent_id')->references('id')->on('posts');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('posts');
	}
}
