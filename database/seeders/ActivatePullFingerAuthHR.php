<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivatePullFingerAuthHR extends Seeder
{
    public function run()
    {
        echo "\n=== AKTIVASI AUTH PULL FINGER UNTUK HR ===\n\n";

        // Langsung pakai idroles='hr' (hardcode, lebih aman)
        $idroles = 'hr';
        echo "✓ Target role: HR (idroles: {$idroles})\n";

        // Get menu Pull Finger
        $pullFingerMenu = DB::table('sys_dmenu')->where('dmenu', 'trspul')->first();
        
        if (!$pullFingerMenu) {
            echo "❌ Menu Pull Finger tidak ditemukan!\n";
            return;
        }
        
        echo "✓ Menu Pull Finger ditemukan: {$pullFingerMenu->name} (dmenu: {$pullFingerMenu->dmenu})\n\n";

        // Cek auth yang ada
        $existingAuth = DB::table('sys_auth')
            ->where('dmenu', 'trspul')
            ->where('idroles', $idroles)
            ->first();

        if ($existingAuth) {
            echo "Auth sudah ada\n";
            echo "Status sekarang:\n";
            echo "  - isactive: {$existingAuth->isactive}\n";
            echo "  - add: {$existingAuth->add}\n";
            echo "  - edit: {$existingAuth->edit}\n";
            echo "  - delete: {$existingAuth->delete}\n\n";
            
            // FORCE UPDATE menggunakan composite key
            $updated = DB::table('sys_auth')
                ->where('dmenu', 'trspul')
                ->where('idroles', $idroles)
                ->update([
                    'add' => 1,
                    'edit' => 1,
                    'delete' => 1,
                    'approval' => 1,
                    'value' => 1,
                    'print' => 1,
                    'excel' => 1,
                    'pdf' => 1,
                    'isactive' => 1,
                    'updated_at' => now()
                ]);
            
            echo "✓ FORCE UPDATE berhasil! Rows affected: {$updated}\n";
        } else {
            echo "Auth belum ada, akan dibuat baru\n\n";
            
            // INSERT baru
            DB::table('sys_auth')->insert([
                'gmenu' => 'transc',
                'dmenu' => 'trspul',
                'idroles' => $idroles,
                'add' => 1,
                'edit' => 1,
                'delete' => 1,
                'approval' => 1,
                'value' => 1,
                'print' => 1,
                'excel' => 1,
                'pdf' => 1,
                'isactive' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            echo "✓ Auth baru berhasil dibuat!\n";
        }

        // VERIFIKASI
        echo "\n=== VERIFIKASI HASIL ===\n\n";
        $verifyAuth = DB::table('sys_auth')
            ->where('dmenu', 'trspul')
            ->where('idroles', $idroles)
            ->first();

        if ($verifyAuth) {
            echo "✓ Auth Pull Finger untuk HR:\n";
            echo "  - idroles: {$verifyAuth->idroles}\n";
            echo "  - dmenu: {$verifyAuth->dmenu}\n";
            echo "  - isactive: {$verifyAuth->isactive} " . ($verifyAuth->isactive == 1 ? '✓' : '❌') . "\n";
            echo "  - add: {$verifyAuth->add} " . ($verifyAuth->add == 1 ? '✓' : '❌') . "\n";
            echo "  - edit: {$verifyAuth->edit} " . ($verifyAuth->edit == 1 ? '✓' : '❌') . "\n";
            echo "  - delete: {$verifyAuth->delete} " . ($verifyAuth->delete == 1 ? '✓' : '❌') . "\n";
            echo "  - approval: {$verifyAuth->approval} " . ($verifyAuth->approval == 1 ? '✓' : '❌') . "\n";
        } else {
            echo "❌ Verifikasi gagal - auth tidak ditemukan!\n";
        }

        echo "\n=== SELESAI ===\n";
    }
}
