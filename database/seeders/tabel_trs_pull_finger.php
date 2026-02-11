<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_trs_pull_finger extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])->delete();

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trspul',
            'urut' => '1',
            'field' => 'id_pull',
            'alias' => 'ID Pull',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:trs_pull_finger,id_pull',
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
            'dmenu' => 'trspul',
            'urut' => '2',
            'field' => 'tanggal_pull',
            'alias' => 'Tanggal Pull',
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
            'dmenu' => 'trspul',
            'urut' => '3',
            'field' => 'waktu_pull',
            'alias' => 'Waktu Pull',
            'type' => 'char',
            'length' => '20',
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
            'dmenu' => 'trspul',
            'urut' => '4',
            'field' => 'jumlah_record',
            'alias' => 'Jumlah Record',
            'type' => 'number',
            'length' => '10',
            'decimals' => '0',
            'default' => '0',
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
            'dmenu' => 'trspul',
            'urut' => '5',
            'field' => 'status',
            'alias' => 'Status',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => '',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trspul',
            'urut' => '6',
            'field' => 'keterangan',
            'alias' => 'Keterangan',
            'type' => 'text',
            'length' => '255',
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
            'dmenu' => 'trspul',
            'urut' => '7',
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
