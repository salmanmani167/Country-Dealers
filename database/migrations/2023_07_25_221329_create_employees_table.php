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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('ssn_id')->nullable();
            $table->string('marital_stat')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('passport_expiry_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('spouse_employement')->nullable();
            $table->string('no_of_children')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('designation_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('agency_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('house_id')->nullable()->constrained()->onDelete('cascade');
            $table->jsonb('education')->nullable();
            $table->jsonb('experience')->nullable();
            $table->jsonb('emergency_contacts')->nullable();
            $table->string('work_availability')->nullable();
            $table->string('work_days')->nullable();
            $table->string('work_transportation')->nullable();
            $table->boolean('have_driver_license')->nullable();
            $table->string('driver_license_no')->nullable();
            $table->jsonb('work_restrictions')->nullable();
            $table->date('date_joined')->nullable()->default(date('Y-m-d'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
