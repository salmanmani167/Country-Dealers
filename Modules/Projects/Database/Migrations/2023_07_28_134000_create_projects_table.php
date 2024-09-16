<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('starts_on');
            $table->date('ends_on');
            $table->double('rate');
            $table->string('rate_type')->nullable();
            $table->string('priority')->nullable();
            $table->foreignId('leader_id')->nullable()->constrained('employees')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->jsonb('files')->nullable();
            $table->date('deadline')->nullable();
            $table->foreignId('added_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->integer('progress')->nullable()->default(0);
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
        Schema::dropIfExists('projects');
    }
};
