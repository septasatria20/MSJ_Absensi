<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_rpt_sp extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'report', 'dmenu' => 'rptspr'])->delete();

        // Query Report
        DB::table('sys_table')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptspr',
            'urut' => '1',
            'field' => 'query',
            'alias' => 'Query',
            'type' => 'report',
            'length' => null,
            'decimals' => '0',
            'default' => '',
            'validate' => '',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '0',
            'query' => "select nik, nama, departemen, total_terlambat, total_alpha, jenis_sp from vw_surat_peringatan where periode between :periode_dari and :periode_sampai",
            'class' => ''
        ]);

        // Filter Periode Dari
        DB::table('sys_table')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptspr',
            'urut' => '2',
            'field' => 'periode_dari',
            'alias' => 'Periode Dari',
            'type' => 'date',
            'length' => null,
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '0',
            'show' => '0',
            'query' => '',
            'class' => ''
        ]);

        // Filter Periode Sampai
        DB::table('sys_table')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptspr',
            'urut' => '3',
            'field' => 'periode_sampai',
            'alias' => 'Periode Sampai',
            'type' => 'date',
            'length' => null,
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '0',
            'show' => '0',
            'query' => '',
            'class' => ''
        ]);
    }
}
