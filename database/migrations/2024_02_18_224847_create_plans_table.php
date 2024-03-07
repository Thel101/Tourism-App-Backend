<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone_no');
            $table->string('trip_details');
            $table->string('destination');
            $table->smallInteger('traveller_count');
            $table->string('travel_date');
            $table->string('accomodation_pref');
            $table->string('room_pref');
            $table->json('interests');
            $table->json('special_requests');
            $table->string('budget_range');
            $table->json('expenses');
            $table->string('additional_comments');
            $table->boolean('subscribe')->default(false);
            $table->enum('status',['new','replied']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
