<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;





class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $role1 = Role::updateOrCreate(['name' => 'Root'], ['name' => 'Root']);//Root
        $role2 = Role::updateOrCreate(['name' => 'Admin'], ['name' => 'Admin']);//Admin
        $role3 = Role::updateOrCreate(['name' => 'Customer'], ['name' => 'Customer']);//Customer
        $role4 = Role::updateOrCreate(['name' => 'Reseller'], ['name' => 'Reseller']);//Customer

        Permission::updateOrCreate(['name'=>'Admin'], ['name'=>'Admin'])->syncRoles([$role1, $role2]);
        Permission::updateOrCreate(['name'=>'Customer'], ['name'=>'Customer'])->syncRoles([$role3, $role4]); 
        
         
    }
}
