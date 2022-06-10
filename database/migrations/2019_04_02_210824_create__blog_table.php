<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('blog', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('subtitle')->nullable();
        $table->text('body_message');
        $table->string('img_url')->nullable();
        $table->timestamps();
        $table->boolean('enabled')->default(true);
        $table->char('type',50);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
