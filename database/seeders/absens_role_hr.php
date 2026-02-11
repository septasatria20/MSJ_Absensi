<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class absens_role_hr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if HR role already exists
        $hrRoleExists = DB::table('sys_roles')->where('idroles', 'hr')->exists();
        
        if (!$hrRoleExists) {
            // Insert HR role if not exists
            DB::table('sys_roles')->insert([
                'idroles' => 'hr',
                'name' => 'HR',
                'description' => 'Human Resources / Personalia',
                'isactive' => '1'
            ]);
        }

        // Give HR access to Dashboard
        $dashboardAuthExists = DB::table('sys_auth')
            ->where(['idroles' => 'hr', 'gmenu' => 'blankx', 'dmenu' => 'dashbr'])
            ->exists();
            
        if (!$dashboardAuthExists) {
            DB::table('sys_auth')->insert([
                'idroles' => 'hr',
                'gmenu' => 'blankx',
                'dmenu' => 'dashbr',
                'add' => '1',
                'edit' => '1',
                'delete' => '1'
            ]);
        }
    }
}
