<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PullFingerMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Insert or update sys_dmenu for Pull Finger
        $existingDmenu = DB::table('sys_dmenu')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])
            ->first();

        if (!$existingDmenu) {
            DB::table('sys_dmenu')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'urut' => 11,
                'name' => 'Pull Finger',
                'url' => 'trspul',
                'icon' => 'ni-cloud-download-95',
                'tabel' => 'trs_pull_finger',
                'layout' => 'transc',
                'show' => 1,
                'js' => 0,
                'isactive' => 1,
                'user_create' => 'system'
            ]);
            echo "✓ Menu Pull Finger berhasil ditambahkan\n";
        } else {
            echo "✓ Menu Pull Finger sudah ada\n";
        }

        // Insert or update sys_auth for Pull Finger (HR role)
        $existingAuth = DB::table('sys_auth')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'hr'])
            ->first();

        if (!$existingAuth) {
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'idroles' => 'hr',
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'approval' => 1,
                'value' => 1,
                'print' => 1,
                'excel' => 1,
                'pdf' => 1,
                'isactive' => 1,
                'user_create' => 'system'
            ]);
            echo "✓ Authorization HR untuk Pull Finger berhasil ditambahkan\n";
        } else {
            // Update existing auth
            DB::table('sys_auth')
                ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'hr'])
                ->update([
                    'add' => 1,
                    'edit' => 1,
                    'delete' => 1,
                    'approval' => 1,
                    'value' => 1,
                    'print' => 1,
                    'excel' => 1,
                    'pdf' => 1,
                    'isactive' => 1
                ]);
            echo "✓ Authorization HR untuk Pull Finger sudah ada dan telah diupdate\n";
        }

        // Insert or update sys_auth for Pull Finger (admins role)
        $existingAuthAdmin = DB::table('sys_auth')
            ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'admins'])
            ->first();

        if (!$existingAuthAdmin) {
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'idroles' => 'admins',
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'approval' => 1,
                'value' => 1,
                'print' => 1,
                'excel' => 1,
                'pdf' => 1,
                'isactive' => 1,
                'user_create' => 'system'
            ]);
            echo "✓ Authorization Admin untuk Pull Finger berhasil ditambahkan\n";
        } else {
            // Update existing auth
            DB::table('sys_auth')
                ->where(['gmenu' => 'transc', 'dmenu' => 'trspul', 'idroles' => 'admins'])
                ->update([
                    'add' => 1,
                    'edit' => 1,
                    'delete' => 1,
                    'approval' => 1,
                    'value' => 1,
                    'print' => 1,
                    'excel' => 1,
                    'pdf' => 1,
                    'isactive' => 1
                ]);
            echo "✓ Authorization Admin untuk Pull Finger sudah ada dan telah diupdate\n";
        }
    }
}
