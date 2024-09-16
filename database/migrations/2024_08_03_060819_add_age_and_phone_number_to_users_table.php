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
        Schema::table('users', function (Blueprint $table) {
            $table->string('middlename')->after('firstname')->nullable();
            $table->string('father_name')->after('middlename')->nullable();
            $table->string('mother_name')->after('father_name')->nullable();
            $table->string('spouse_name')->after('mother_name')->nullable();
            $table->timestamp('date_of_joining')->after('password')->nullable();
            $table->string('blood_group')->after('date_of_joining')->nullable();
            $table->string('nationality')->after('country')->nullable();
            $table->string('religion')->after('nationality')->nullable();
            $table->string('marital_status')->after('religion')->nullable();
            $table->timestamp('marital_anniversary')->after('marital_status')->nullable();
            $table->longText('present_address')->after('marital_anniversary')->nullable();
            $table->longText('permanent_address')->after('present_address')->nullable();
            $table->string('emergency_contact_person')->after('permanent_address')->nullable();
            $table->string('emergency_contact_number')->after('emergency_contact_person')->nullable();
            $table->string('employee_code')->after('lastname')->nullable();
            $table->string('business_unit')->after('employee_code')->nullable();
            $table->string('department')->after('business_unit')->nullable();
            $table->string('section')->after('department')->nullable();
            $table->string('designation')->after('section')->nullable();
            $table->string('grade')->after('designation')->nullable();
            $table->string('level')->after('grade')->nullable();
            $table->string('company_email')->after('level')->nullable();
            $table->string('pf_uan')->after('company_email')->nullable();
            $table->string('esi')->after('pf_uan')->nullable();
            $table->string('medical_insurance')->after('esi')->nullable();
            $table->string('primary_bank_account')->after('medical_insurance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('middlename');
            $table->dropColumn('father_name');
            $table->dropColumn('mother_name');
            $table->dropColumn('spouse_name');
            $table->dropColumn('date_of_joining');
            $table->dropColumn('blood_group');
            $table->dropColumn('nationality');
            $table->dropColumn('religion');
            $table->dropColumn('marital_status');
            $table->dropColumn('marital_anniversary');
            $table->dropColumn('present_address');
            $table->dropColumn('permanent_address');
            $table->dropColumn('emergency_contact_person');
            $table->dropColumn('emergency_contact_number');
            $table->dropColumn('employee_code');
            $table->dropColumn('business_unit');
            $table->dropColumn('department');
            $table->dropColumn('section');
            $table->dropColumn('designation');
            $table->dropColumn('grade');
            $table->dropColumn('level');
            $table->dropColumn('company_email');
            $table->dropColumn('pf_uan');
            $table->dropColumn('esi');
            $table->dropColumn('medical_insurance');
            $table->dropColumn('primary_bank_account');
        });
    }
};
