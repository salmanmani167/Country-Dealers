<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('features')->insert([
            [
                'feature' => 'apps',
                'active_at' => now(),
            ],
            [
                'feature' => 'calendar',
                'active_at' => now(),
            ],
            [
                'feature' => 'filemanager',
                'active_at' => now(),
            ],
            [
                'feature' => 'company',
                'active_at' => now(),
            ],
            [
                'feature' => 'employees',
                'active_at' => now(),
            ],
            [
                'feature' => 'attendance',
                'active_at' => now(),
            ],
            [
                'feature' => 'holidays',
                'active_at' => now(),
            ],
            [
                'feature' => 'vacations',
                'active_at' => now(),
            ],
            [
                'feature' => 'timesheet',
                'active_at' => now(),
            ],
            [
                'feature' => 'overtime',
                'active_at' => now(),
            ],
            [
                'feature' => 'shifts',
                'active_at' => now(),
            ],
            [
                'feature' => 'clients',
                'active_at' => now(),
            ],
            [
                'feature' => 'projects',
                'active_at' => now(),
            ],
            [
                'feature' => 'leads',
                'active_at' => now(),
            ],
            [
                'feature' => 'tickets',
                'active_at' => now(),
            ],
            [
                'feature' => 'accounts',
                'active_at' => now(),
            ],
            [
                'feature' => 'invoices',
                'active_at' => now(),
            ],
            [
                'feature' => 'expenses',
                'active_at' => now(),
            ],
            [
                'feature' => 'provident-fund',
                'active_at' => now(),
            ],
            [
                'feature' => 'taxes',
                'active_at' => now(),
            ],
            [
                'feature' => 'products',
                'active_at' => now(),
            ],
            [
                'feature' => 'sales',
                'active_at' => now(),
            ],
            [
                'feature' => 'policies',
                'active_at' => now(),
            ],
            [
                'feature' => 'jobs',
                'active_at' => now(),
            ],
            [
                'feature' => 'reports',
                'active_at' => now(),
            ],
            [
                'feature' => 'goals',
                'active_at' => now(),
            ],
            [
                'feature' => 'assets',
                'active_at' => now(),
            ],
            [
                'feature' => 'announcement',
                'active_at' => now(),
            ],
            [
                'feature' => 'backups',
                'active_at' => now(),
            ],

        ]);
    }
}
