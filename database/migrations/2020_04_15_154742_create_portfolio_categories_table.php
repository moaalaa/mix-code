<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_categories', function (Blueprint $table) {
           
            
            $table->uuid('id')->primary();

            // card Id
            $table->uuid('portfolio_id')->nullable();

            // card Id
            $table->foreign('portfolio_id')
                ->references('id')
                ->on('portfolios')
                ->onDelete('set null');

            // Category Id
            $table->uuid('category_id')->nullable();

            // Category Id
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('set null');

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
        Schema::dropIfExists('portfolio_categories');
    }
}
