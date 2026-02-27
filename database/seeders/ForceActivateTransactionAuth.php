<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForceActivateTransactionAuth extends Seeder
{
    public function run(): void
    {
        echo "\n=== FORCE ACTIVATE TRANSACTION AUTH ===\n\n";
        
        $roles = ['hr', 'msjit'];
        $dmenus = ['trstuk', 'trspul', 'trsmis'];
        
        foreach ($dmenus as $dmenu) {
            echo "Processing dmenu: {$dmenu}\n";
            
            foreach ($roles as $role) {
                // Check if exists
                $exists = DB::table('sys_auth')
                    ->where('dmenu', $dmenu)
                    ->where('idroles', $role)
                    ->first();
                
                if ($exists) {
                    // Force UPDATE
                    $updated = DB::table('sys_auth')
                        ->where('dmenu', $dmenu)
                        ->where('idroles', $role)
                        ->update([
                            'add' => '1',
                            'edit' => '1',
                            'delete' => '1',
                            'approval' => '1',
                            'value' => '1',
                            'print' => '1',
                            'excel' => '1',
                            'pdf' => '1',
                            'isactive' => '1',
                        ]);
                    
                    echo "   ✓ UPDATED auth for role={$role} (rows affected: {$updated})\n";
                    
                    // Verify
                    $verify = DB::table('sys_auth')
                        ->where('dmenu', $dmenu)
                        ->where('idroles', $role)
                        ->first();
                    
                    echo "     Verification: isactive={$verify->isactive}, add={$verify->add}\n";
                    
                } else {
                    // INSERT
                    DB::table('sys_auth')->insert([
                        'gmenu' => 'transc',
                        'dmenu' => $dmenu,
                        'idroles' => $role,
                        'add' => '1',
                        'edit' => '1',
                        'delete' => '1',
                        'approval' => '1',
                        'value' => '1',
                        'print' => '1',
                        'excel' => '1',
                        'pdf' => '1',
                        'isactive' => '1',
                    ]);
                    
                    echo "   ✓ INSERTED new auth for role={$role}\n";
                }
            }
            
            echo "\n";
        }
        
        // Final verification
        echo "=== FINAL VERIFICATION ===\n\n";
        
        foreach ($dmenus as $dmenu) {
            $menuName = DB::table('sys_dmenu')->where('dmenu', $dmenu)->value('name');
            echo "{$menuName} ({$dmenu}):\n";
            
            foreach ($roles as $role) {
                $auth = DB::table('sys_auth')
                    ->where('dmenu', $dmenu)
                    ->where('idroles', $role)
                    ->first();
                
                if ($auth) {
                    echo "   {$role}: isactive={$auth->isactive}, add={$auth->add}, edit={$auth->edit}, delete={$auth->delete}\n";
                } else {
                    echo "   {$role}: NOT FOUND!\n";
                }
            }
            echo "\n";
        }
        
        echo "=== DONE ===\n\n";
    }
}
