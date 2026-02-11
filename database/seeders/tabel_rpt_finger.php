<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_rpt_finger extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'report', 'dmenu' => 'rptfng'])->delete();

        // Query Report
        DB::table('sys_table')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptfng',
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
            'query' => "select nik, nama, tanggal, jam_masuk, jam_pulang, status from vw_absensi_report where tanggal between :tanggal_dari and :tanggal_sampai",
            'class' => ''
        ]);

        // Filter Tanggal Dari
        DB::table('sys_table')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptfng',
            'urut' => '2',
            'field' => 'tanggal_dari',
            'alias' => 'Tanggal Dari',
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

        // Filter Tanggal Sampai
        DB::table('sys_table')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptfng',
            'urut' => '3',
            'field' => 'tanggal_sampai',
            'alias' => 'Tanggal Sampai',
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
