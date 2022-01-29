<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinboardPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// TODO: Add to readme that you must create a MYSQL DB with the name pinboard_scraper and setup user/pass config
        Schema::create('pinboard_posts', function (Blueprint $table) {
            $table->id();
			$table->string('url');
			$table->string('title');
			$table->string('description');
			$table->string('tags');
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
        Schema::dropIfExists('pinboard_posts');
    }
}
