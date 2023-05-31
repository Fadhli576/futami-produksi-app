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
        Schema::create('processings', function (Blueprint $table) {
            $table->id();
            $table->string('produksi_id');
            $table->float('volume_mixing');
            $table->string('drain_out');
            $table->string('volume');
            $table->string('density_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processings');
    }
};
