<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trs_data_missing', function (Blueprint $table) {
            $table->char('id_missing', 6);
            $table->string('nik', 20)->nullable();
            $table->string('nama_karyawan', 100)->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('jenis_anomali', ['mangkir', 'terlambat', 'pulang_cepat'])->nullable()->comment('mangkir=tidak absen & tidak izin/cuti, terlambat=telat tanpa izin, pulang_cepat=pulang awal tanpa izin');
            $table->time('jam_seharusnya_masuk')->nullable();
            $table->time('jam_aktual_masuk')->nullable();
            $table->time('jam_seharusnya_pulang')->nullable();
            $table->time('jam_aktual_pulang')->nullable();
            $table->integer('durasi_keterlambatan')->nullable()->comment('dalam menit');
            $table->string('no_telp', 20)->nullable();
            $table->enum('status_hubungi', ['belum', 'sudah'])->default('belum');
            $table->datetime('waktu_hubungi')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status_laporan', ['pending', 'resolved', 'reported'])->default('pending')->comment('pending=dalam 24 jam, resolved=sudah ditangani, reported=masuk report');
            $table->enum('isactive', [0, 1])->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
            $table->primary(['id_missing']);
            $table->comment('Tabel untuk monitoring anomali absensi (mangkir, terlambat, pulang cepat). Data berlaku 24 jam sebelum masuk report.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_data_missing');
    }
};
