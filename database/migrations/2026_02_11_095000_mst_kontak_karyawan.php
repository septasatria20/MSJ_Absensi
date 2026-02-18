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
        Schema::create('mst_kontak_karyawan', function (Blueprint $table) {
            $table->char('id_kontak', 6);
            $table->string('nik', 20)->nullable();
            $table->string('nama_karyawan', 100)->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('no_wa', 20)->nullable()->comment('Nomor WhatsApp bisa beda dengan no telp');
            $table->string('email', 100)->nullable();
            $table->string('kontak_darurat', 20)->nullable();
            $table->string('nama_kontak_darurat', 100)->nullable();
            $table->enum('isactive', [0, 1])->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
            $table->primary(['id_kontak']);
            $table->unique(['nik']);
            $table->comment('Master kontak karyawan untuk keperluan komunikasi (WA, email, dll)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_kontak_karyawan');
    }
};
