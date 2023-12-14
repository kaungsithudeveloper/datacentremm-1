<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdmin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('111'),
            'phone' => '09422526217',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $Admin = User::create([
            'name' => 'Hla',
            'username' => 'hla',
            'email' => 'hla@gmail.com',
            'password' => Hash::make('111'),
            'phone' => '09450127304',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $Editor = User::create([
            'name' => 'naung',
            'username' => 'naung',
            'email' => 'naung@gmail.com',
            'password' => Hash::make('111'),
            'phone' => '09450127303',
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user = User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('111'),
            'phone' => '09450127305',
            'role' => 'user',
            'status' => 'active',
        ]);

        if (!Role::where('name', 'SuperAdmin')->exists()) {
            $superAdminRole = Role::create(['name' => 'SuperAdmin']);
            $AdminRole = Role::create(['name' => 'Admin']);
            $EditorRole = Role::create(['name' => 'Editor']);
        } else {
            $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        }

        if ($superAdminRole) {
            $SuperAdmin->assignRole($superAdminRole);
        }

        if ($AdminRole) {
            $Admin->assignRole($AdminRole);
        }

        if ($EditorRole) {
            $Editor->assignRole($EditorRole);
        }


    }
}
