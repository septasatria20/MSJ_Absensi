<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_mst_kontak_karyawan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'master', 'dmenu' => 'mstknk'])->delete();

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '1',
            'field' => 'id_kontak',
            'alias' => 'ID',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:mst_kontak_karyawan,id_kontak',
            'primary' => '1',
            'generateid' => 'KNK',
            'filter' => '0',
            'list' => '0',
            'show' => '0',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '2',
            'field' => 'nik',
            'alias' => 'NIK',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:20|unique:mst_kontak_karyawan,nik',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '3',
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
            'dmenu' => 'mstknk',
            'urut' => '4',
            'field' => 'no_telp',
            'alias' => 'No. Telp',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'max:20',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '5',
            'field' => 'no_wa',
            'alias' => 'No. WhatsApp',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:20',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '6',
            'field' => 'email',
            'alias' => 'Email',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'email|max:100',
            'primary' => '0',
            'filter' => '0',
            'list' => '1',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '7',
            'field' => 'kontak_darurat',
            'alias' => 'Kontak Darurat',
            'type' => 'string',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'max:20',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '8',
            'field' => 'nama_kontak_darurat',
            'alias' => 'Nama Kontak Darurat',
            'type' => 'string',
            'length' => '100',
            'decimals' => '0',
            'default' => '',
            'validate' => 'max:100',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => 'upper'
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => '9',
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
