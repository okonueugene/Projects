<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Felix Mutinda', 
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'super_admin',
        ]);

        $user3 = User::create([
            'name' => 'Test Client', 
            'email' => 'client@demo.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'client',
        ]);

        $user2 = User::create([
            'name' => 'Brown Ken', 
            'email' => 'bken0480@gmail.com',
            'password' => Hash::make('12345678'),
            'user_type' => 'admin',
            'company_id' => 1,
        ]);
    
        $role = Role::find(1);

        $permissions = Permission::pluck('id', 'id')->all();
   
        $role->syncPermissions($permissions);
     
        $user2->assignRole([$role->id]);
    }
}
