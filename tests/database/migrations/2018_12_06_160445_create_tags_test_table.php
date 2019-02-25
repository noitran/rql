<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('uuid', 64)->nullable()->unique();

            $table->string('name');

            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table): void {
            $table->increments('id');

            $table->unsignedInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onUpdate('cascade');

            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
    }
}
