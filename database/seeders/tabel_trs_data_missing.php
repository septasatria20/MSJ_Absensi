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
            'alias' => 'ID',
            'type' => 'char',
            'length' => '6',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required|max:6|unique:trs_data_missing,id_missing',
            'primary' => '1',
            'generateid' => 'DMS',
            'filter' => '0',
            'list' => '0',
            'show' => '0',
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
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '4',
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
            'urut' => '5',
            'field' => 'jenis_anomali',
            'alias' => 'Jenis Anomali',
            'type' => 'enum',
            'length' => '20',
            'decimals' => '0',
            'default' => '',
            'validate' => 'required',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'mangkir' as value, 'Mangkir' as name union select 'terlambat' as value, 'Terlambat' as name union select 'pulang_cepat' as value, 'Pulang Cepat' as name"
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '6',
            'field' => 'jam_seharusnya_masuk',
            'alias' => 'Jam Seharusnya Masuk',
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
            'urut' => '7',
            'field' => 'jam_aktual_masuk',
            'alias' => 'Jam Aktual Masuk',
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
            'urut' => '8',
            'field' => 'jam_seharusnya_pulang',
            'alias' => 'Jam Seharusnya Pulang',
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
            'urut' => '9',
            'field' => 'jam_aktual_pulang',
            'alias' => 'Jam Aktual Pulang',
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
            'urut' => '10',
            'field' => 'durasi_keterlambatan',
            'alias' => 'Durasi Terlambat (menit)',
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
            'dmenu' => 'trsmis',
            'urut' => '11',
            'field' => 'no_telp',
            'alias' => 'No. Telp/WA',
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
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '12',
            'field' => 'status_hubungi',
            'alias' => 'Status Hubungi',
            'type' => 'enum',
            'length' => '10',
            'decimals' => '0',
            'default' => 'belum',
            'validate' => '',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'belum' as value, 'Belum' as name union select 'sudah' as value, 'Sudah' as name"
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '13',
            'field' => 'catatan',
            'alias' => 'Catatan',
            'type' => 'text',
            'length' => '255',
            'decimals' => '0',
            'default' => '',
            'validate' => '',
            'primary' => '0',
            'filter' => '0',
            'list' => '0',
            'show' => '1',
            'query' => '',
            'class' => ''
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '14',
            'field' => 'status_laporan',
            'alias' => 'Status Laporan',
            'type' => 'enum',
            'length' => '10',
            'decimals' => '0',
            'default' => 'pending',
            'validate' => '',
            'primary' => '0',
            'filter' => '1',
            'list' => '1',
            'show' => '1',
            'query' => "select 'pending' as value, 'Pending (< 24 jam)' as name union select 'resolved' as value, 'Resolved' as name union select 'reported' as value, 'Sudah Dilaporkan' as name"
        ]);

        DB::table('sys_table')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => '15',
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
