<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use MixCode\User;

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
            $table->uuid('id')->primary();
            
             $table->string('full_name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('lang')->nullable();
            $table->enum('type', ['customer', 'admin'])->default('customer');
            $table->enum('status', [User::ACTIVE_STATUS, User::PENDING_STATUS, User::INACTIVE_STATUS])->default(User::ACTIVE_STATUS);
            
            $table->rememberToken();


            $table->softDeletes();
            $table->timestamps();

             $table->index('type');
            $table->index('status');
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
