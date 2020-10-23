<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->uuid('id')->primary();
 
            $table->string('url')->nullable();
 
            $table->enum('status', [ 'active','disabled' ])->default('active');

            $table->uuid('creator_id')->nullable();
            $table->uuid('client_id')->nullable();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');


            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('set null');

            $table->softDeletes();

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
        Schema::dropIfExists('portfolios');
    }
}
