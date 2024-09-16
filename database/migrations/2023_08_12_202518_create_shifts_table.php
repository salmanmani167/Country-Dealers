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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('min_start_time')->nullable();
            $table->string('start_time');
            $table->string('max_start_time')->nullable();
            $table->string('min_end_time')->nullable();
            $table->string('end_time');
            $table->string('max_end_time')->nullable();
            $table->time('break')->nullable();
            $table->boolean('recurring')->nullable()->default(false);
            $table->integer('repeat_weeks')->nullable();
            $table->jsonb('days')->nullable();
            $table->date('ends_on')->nullable();
            $table->boolean('indefinite')->nullable()->default(false);
            $table->string('tag')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
