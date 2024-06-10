<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->string('username', 255)->unique()->comment('Unique');
            $table->string('email');
            $table->string('password', 255)->comment('Encrypted password');
            $table->string('avatar', 255)->nullable()->comment('URL to avatar image');
            $table->text('description')->nullable()->comment('User description');
            $table->enum('role', ['Admin', 'Manager', 'User'])->default('User')->comment('User role');
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
        Schema::dropIfExists('users');
    }
}
