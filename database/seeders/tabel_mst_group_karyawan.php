<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_mst_group_karyawan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'master', 'dmenu' => 'mstgrp'])->delete();

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstgrp',
            'urut' => '1',
            'field' => 'id_group',
            'alias' => 'ID Group',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6',
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
            'dmenu' => 'mstgrp',
            'urut' => '2',
            'field' => 'nik',
            'alias' => 'NIK',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:20',
            'primary' => '2',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstgrp',
            'urut' => '3',
            'field' => 'id_shift',
            'alias' => 'Shift',
            'type' => 'enum',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select id_shift as value, concat(id_shift, ' - ', nama_shift) as name from mst_shift where isactive = '1'"
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstgrp',
            'urut' => '4',
            'field' => 'nama_karyawan',
            'alias' => 'Nama Karyawan',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:100',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstgrp',
            'urut' => '5',
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
