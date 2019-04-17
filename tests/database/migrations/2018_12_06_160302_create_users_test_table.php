<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTestTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->increments('id');
            $table->string('uuid', 64)->nullable()->unique();

            $table->string('name')->nullable();
            $table->string('surname')->nullable();

            $table->string('email')->nullable()->unique();
            $table->string('email_verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->timestamp('last_logged_in_at')->nullable();
            $table->timestamp('disabled_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
