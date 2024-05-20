<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::factory()->create([
            'name' => 'SIAG SMART',
            'slug' => 'siga-smart',
            'email' => 'contato@sigasmart.com.br',
            'status' => 'published',
            'document' => '00000000000000',
            'domain' => request()->getHost(),
            'phone' => '0000000000',
        ]);
    }
}
