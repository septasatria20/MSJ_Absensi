<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_mst_shift extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'master', 'dmenu' => 'mstshf'])->delete();

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => '1',
            'field' => 'id_shift',
            'alias' => 'ID Shift',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:mst_shift,id_shift',
            'primary' => '1',
            'generateid' => '',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => '2',
            'field' => 'nama_shift',
            'alias' => 'Nama Shift',
            'type' => 'string',
            'length' => '50',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:50',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => '3',
            'field' => 'jam_masuk',
            'alias' => 'Jam Masuk',
            'type' => 'time',
            'length' => null,
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
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => '4',
            'field' => 'jam_pulang',
            'alias' => 'Jam Pulang',
            'type' => 'time',
            'length' => null,
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
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => '5',
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
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => '6',
            'field' => 'isactive',
            'alias' => 'Status',
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
