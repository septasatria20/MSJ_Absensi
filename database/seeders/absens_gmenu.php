<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class absens_gmenu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //delete sys_auth
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'mstshf'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'mstmpn'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'mstgrp'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'msthln'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'msthls'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'mstkry'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'master', 'dmenu' => 'mstknk'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'transc', 'dmenu' => 'trstuk'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'transc', 'dmenu' => 'trspul'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'transc', 'dmenu' => 'trsmis'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'report', 'dmenu' => 'rptfng'])->delete();
        DB::table('sys_auth')->where(['idroles' => 'hr', 'gmenu' => 'report', 'dmenu' => 'rptspr'])->delete();
        
        //delete sys_dmenu
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'mstshf'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'mstmpn'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'mstgrp'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'msthln'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'msthls'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'mstkry'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'master', 'dmenu' => 'mstknk'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'transc', 'dmenu' => 'trstuk'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'transc', 'dmenu' => 'trspul'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'transc', 'dmenu' => 'trsmis'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'report', 'dmenu' => 'rptfng'])->delete();
        DB::table('sys_dmenu')->where(['gmenu' => 'report', 'dmenu' => 'rptspr'])->delete();

        //insert tabel sys_dmenu - Master Data
        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'urut' => 10,
            'name' => 'Shift',
            'url' => 'mstshf',
            'icon' => 'ni-watch-time',
            'tabel' => 'mst_shift',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstmpn',
            'urut' => 11,
            'name' => 'Mapping NIK',
            'url' => 'mstmpn',
            'icon' => 'ni-badge',
            'tabel' => 'mst_mapping_nik',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstgrp',
            'urut' => 12,
            'name' => 'Group Karyawan',
            'url' => 'mstgrp',
            'icon' => 'ni-circle-08',
            'tabel' => 'trk_karyawan_group',
            'layout' => 'master'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'msthln',
            'urut' => 13,
            'name' => 'Hari Libur Non-Shift',
            'url' => 'msthln',
            'icon' => 'ni-world-2',
            'tabel' => 'mst_hari_libur_non_shift',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'msthls',
            'urut' => 14,
            'name' => 'Hari Libur Shift',
            'url' => 'msthls',
            'icon' => 'ni-calendar-grid-58',
            'tabel' => 'mst_hari_libur_shift',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstkry',
            'urut' => 15,
            'name' => 'Karyawan',
            'url' => 'mstkry',
            'icon' => 'ni-badge',
            'tabel' => 'mst_karyawan_hris',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'urut' => 16,
            'name' => 'Kontak Karyawan',
            'url' => 'mstknk',
            'icon' => 'ni-mobile-button',
            'tabel' => 'mst_kontak_karyawan',
            'layout' => 'standr'
        ]);

        //insert tabel sys_dmenu - Transaksi
        DB::table('sys_dmenu')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trstuk',
            'urut' => 10,
            'name' => 'Tukar Jadwal',
            'url' => 'trstuk',
            'icon' => 'ni-delivery-fast',
            'tabel' => 'trs_tukar_jadwal',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trspul',
            'urut' => 11,
            'name' => 'Pull Finger',
            'url' => 'trspul',
            'icon' => 'ni-cloud-download-95',
            'tabel' => 'trs_pull_finger',
            'layout' => 'standr'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'urut' => 12,
            'name' => 'Data Missing',
            'url' => 'trsmis',
            'icon' => 'ni-single-copy-04',
            'tabel' => 'trs_data_missing',
            'layout' => 'standr'
        ]);

        //insert tabel sys_dmenu - Report
        DB::table('sys_dmenu')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptfng',
            'urut' => 10,
            'name' => 'Report Finger',
            'url' => 'rptfng',
            'icon' => 'ni-chart-bar-32',
            'tabel' => '-',
            'layout' => 'report'
        ]);

        DB::table('sys_dmenu')->insert([
            'gmenu' => 'report',
            'dmenu' => 'rptspr',
            'urut' => 11,
            'name' => 'Report SP',
            'url' => 'rptspr',
            'icon' => 'ni-email-83',
            'tabel' => '-',
            'layout' => 'report'
        ]);

        //insert tabel sys_auth untuk role HR
        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'mstshf',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'mstmpn',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'mstgrp',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'msthln',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'msthls',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'mstkry',
            'add' => '0',
            'edit' => '0',
            'delete' => '0'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'master',
            'dmenu' => 'mstknk',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'transc',
            'dmenu' => 'trstuk',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'transc',
            'dmenu' => 'trspul',
            'add' => '1',
            'edit' => '0',
            'delete' => '0'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'transc',
            'dmenu' => 'trsmis',
            'add' => '1',
            'edit' => '1',
            'delete' => '1'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'report',
            'dmenu' => 'rptfng',
            'add' => '1',
            'edit' => '0',
            'delete' => '0'
        ]);

        DB::table('sys_auth')->insert([
            'idroles' => 'hr',
            'gmenu' => 'report',
            'dmenu' => 'rptspr',
            'add' => '1',
            'edit' => '0',
            'delete' => '0'
        ]);
    }
}
