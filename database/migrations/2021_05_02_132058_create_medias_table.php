<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('title', 255);
            $table->string('type', 50)->nullable();
            $table->string('url', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->string('caption', 255)->nullable();
            $table->string('place_storage', 100)->nullable();
            $table->string('size', 100)->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('medias');
    }
}
