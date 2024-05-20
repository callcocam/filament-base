<?php

namespace Database\Seeders;

use App\Models\Acl\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin', // 'super-admin' => 'all-access
                'special' => 'all-access',
                'description' => 'Super Admin Role',
                'status' => 'published'
            ], [
                'name' => 'Admin',
                'slug' => 'admin', // 'admin' => 'all-access
                'special' => null,
                'description' => 'Admin Role',
                'status' => 'published'
            ], [
                'name' => 'User',
                'slug' => 'user', // 'user' => 'no-access
                'special' => null,
                'description' => 'User Role',
                'status' => 'published'
            ],
        ];

        foreach ($roles as $role) {
            Role::factory()->create($role);
        }

        $host = request()->getHost();
        if ($host === 'localhost') {
            $host = 'example.com';
        }

        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => sprintf('super-admin@%s', $host),
        ]);

        $superAdmin->assignRoles('super-admin');

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => sprintf('admin@%s', $host),
        ]);

        $admin->assignRoles('admin');

        $user = User::factory()->create([
            'name' => 'User',
            'email' => sprintf('user@%s', $host),
        ]);

        $user->assignRoles('user');

        $jonDoe = User::factory()->create([
            'name' => 'Jon Doe',
            'email' => sprintf('jondoe@%s', $host),
        ]);

        $jonDoe->assignRoles('user');

        $janeDoe = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => sprintf('janedoe@%s', $host),
        ]);

        $janeDoe->assignRoles('user');
    }
}
