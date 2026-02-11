<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_trs_data_missing extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'transc', 'dmenu' => 'trsmis'])->delete();

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '1',
            'field' => 'id_missing',
            'alias' => 'ID Missing',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:trs_data_missing,id_missing',
            'primary' => '1',
            'generateid' => '',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '2',
            'field' => 'nik',
            'alias' => 'NIK',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:20',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '3',
            'field' => 'tanggal',
            'alias' => 'Tanggal',
            'type' => 'date',
            'length' => null,
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '4',
            'field' => 'jam_masuk',
            'alias' => 'Jam Masuk',
            'type' => 'char',
            'length' => '5',
            'decimals' => '0',
            'default' => '',
            'validate' => '',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '5',
            'field' => 'jam_pulang',
            'alias' => 'Jam Pulang',
            'type' => 'char',
            'length' => '5',
            'decimals' => '0',
            'default' => '',
            'validate' => '',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '6',
            'field' => 'alasan',
            'alias' => 'Alasan',
            'type' => 'text',
            'length' => '255',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '7',
            'field' => 'status',
            'alias' => 'Status',
            'type' => 'enum',
            'length' => '10',
            'decimals' => '0',
            'default' => 'pending',
            'validate' => '',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'pending' as value, 'Pending' as name union select 'approved' as value, 'Approved' as name union select 'rejected' as value, 'Rejected' as name"
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '8',
            'field' => 'isactive',
            'alias' => 'Active',
            'type' => 'enum',
            'length' => '1',
            'decimals' => '0',
            'default' => '1',
            'validate' => '',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select value, name from sys_enum where idenum = 'isactive' and isactive = '1'"
        ]);
    }
}
