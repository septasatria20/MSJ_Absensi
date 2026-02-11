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
        Schema::create('trs_tukar_jadwal', function (Blueprint $table) {
            $table->char('id_tukar', 6);
            $table->string('nik_pengganti', 20)->nullable();
            $table->string('nik_diganti', 20)->nullable();
            $table->date('tanggal_tukar')->nullable();
            $table->char('id_shift_asal', 6)->nullable();
            $table->char('id_shift_baru', 6)->nullable();
            $table->text('alasan')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('isactive', [0, 1])->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('user_create')->nullable();
            $table->string('user_update')->nullable();
            $table->primary(['id_tukar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trs_tukar_jadwal');
    }
};
