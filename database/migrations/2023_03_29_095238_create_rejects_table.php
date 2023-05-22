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
        Schema::create('rejects', function (Blueprint $table) {
            $table->id();
            $table->string('produksi_id');
            $table->string('batch_id');
            $table->string('id_jenis_reject');
            $table->string('id_tempat_reject')->nullable();
            $table->string('id_spesifik_tempat')->nullable();
            $table->string('id_paramater_reject')->nullable();
            $table->string('jumlah_botol')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejects');
    }
};
