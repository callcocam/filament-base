<?php

namespace Database\Seeders;

use App\Core\Helpers\LoadRouterHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoadRouterHelper::make()->save();
    }
}
