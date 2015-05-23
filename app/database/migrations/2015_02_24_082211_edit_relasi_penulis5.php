<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditRelasiPenulis5 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('artikel_penulis', function(Blueprint $table){
		    $table->renameColumn('id_artikel', 'artikel_id');		
		    $table->renameColumn('id_penulis', 'penulis_id');		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
