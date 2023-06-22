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
            $table->string('reject_supplier_karton')->nullable();
            $table->string('reject_supplier_lakban')->nullable();
            $table->string('reject_supplier_lakban2')->nullable();

            $table->string('jatuh_filling_cap')->nullable();
            $table->string('sampel_cap')->nullable();
            $table->string('trial_cap')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('varians', function (Blueprint $table) {
            $table->dropColumn('reject_supplier_karton');
            $table->dropColumn('reject_supplier_lakban');
        });
    }
};
