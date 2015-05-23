<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NambahTabelDownloader extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('downloader', function($table){
		    $table->increments('id');
		    $table->string('name');
		    $table->string('email');
		    $table->string('phone');
		    $table->timestamps();
		});

		Schema::create('article_downloader', function($table){
		    $table->increments('id');
		    $table->integer('article_id');
		    $table->integer('downloader_id');
		    $table->date('date');
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
		Schema::drop('downloader');
		Schema::drop('article_downloader');
	}

}
