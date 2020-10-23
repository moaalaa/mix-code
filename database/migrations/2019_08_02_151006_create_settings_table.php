<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Basic
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->longText('map_url')->nullable();

            // Socials
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('youtube')->nullable();

            // About Us
            $table->longText('en_about_us')->nullable();
            $table->longText('ar_about_us')->nullable();
            
            $table->longText('en_mission')->nullable();
            $table->longText('ar_mission')->nullable();
            
            $table->longText('en_vision')->nullable();
            $table->longText('ar_vision')->nullable();

            $table->longText('en_values')->nullable();
            $table->longText('ar_values')->nullable();

            // Terms And Conditions
            $table->longText('en_terms_and_conditions')->nullable();
            $table->longText('ar_terms_and_conditions')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
