<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('en_name');
            $table->string('ar_name');
     
            $table->longText('en_overview')->nullable();
            $table->longText('ar_overview')->nullable();
    

            $table->uuid('creator_id')->nullable();

            $table->foreign('creator_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('courses');
    }
}
