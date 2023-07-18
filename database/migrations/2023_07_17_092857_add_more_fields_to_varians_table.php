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
        Schema::table('varians', function (Blueprint $table) {
            $table->integer('saldo_awal_cap')->nullable();
            $table->integer('saldo_awal_label')->nullable();
            $table->integer('saldo_awal_karton')->nullable();
            $table->integer('saldo_awal_lakban1')->nullable();
            $table->integer('saldo_awal_lakban2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('varians', function (Blueprint $table) {
            //
        });
    }
};
