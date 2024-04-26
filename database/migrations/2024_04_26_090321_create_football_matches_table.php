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
        Schema::create('football_matches', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_1_id');
            $table->foreign('team_1_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('team_2_id');
            $table->foreign('team_2_id')->references('id')->on('teams')->onDelete('cascade');

            $table->unsignedBigInteger('team_1_score')->default(0);
            $table->unsignedBigInteger('team_2_score')->default(0);
            $table->boolean('evaluated')->default(false);
            $table->dateTime('starts_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('football_matches');
    }
};
