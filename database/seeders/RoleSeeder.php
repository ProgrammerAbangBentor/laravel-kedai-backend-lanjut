<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'user',
            'staff',
            // Tambahkan role lain sesuai kebutuhan
        ];

        // Loop untuk membuat setiap role
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Jika seeder berhasil dijalankan, maka roles akan tercipta di database
        $this->command->info('Roles berhasil ditambahkan.');
    }
}
