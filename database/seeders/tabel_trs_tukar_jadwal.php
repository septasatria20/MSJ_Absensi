<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tabel_trs_tukar_jadwal extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sys_table')->where(['gmenu' => 'transc', 'dmenu' => 'trstuk'])->delete();

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trstuk',
            'urut' => '1',
            'field' => 'id_tukar',
            'alias' => 'ID Tukar',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:trs_tukar_jadwal,id_tukar',
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
            'dmenu' => 'trstuk',
            'urut' => '2',
            'field' => 'nik_pengganti',
            'alias' => 'NIK Pengganti',
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
            'dmenu' => 'trstuk',
            'urut' => '3',
            'field' => 'nik_diganti',
            'alias' => 'NIK Diganti',
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
            'dmenu' => 'trstuk',
            'urut' => '4',
            'field' => 'tanggal_tukar',
            'alias' => 'Tanggal Tukar',
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
            'dmenu' => 'trstuk',
            'urut' => '5',
            'field' => 'id_shift_asal',
            'alias' => 'Shift Asal',
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
            'gmenu' => 'transc',
            'dmenu' => 'trstuk',
            'urut' => '6',
            'field' => 'id_shift_baru',
            'alias' => 'Shift Baru',
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
            'gmenu' => 'transc',
            'dmenu' => 'trstuk',
            'urut' => '7',
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
            'dmenu' => 'trstuk',
            'urut' => '8',
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
            'dmenu' => 'trstuk',
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
