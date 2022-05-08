<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->insert([
            [
                'role_name' => 'admin',
            ],
            [
                'role_name' => 'customer',
            ],
            [
                'role_name' => 'delivery_boy',
            ],
            [
                'role_name' => 'seller',
            ],
            [
                'role_name' => 'partner',
            ],
            [
                'role_name' => 'support',
            ]
        ]);    
    }
}
