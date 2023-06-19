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
        Schema::create('varians', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('produksi_id')->nullable();
            $table->string('parameter_id');
            $table->string('botol_id');
            $table->string('cap_id');
            $table->string('label_id');
            $table->string('karton_id');
            $table->string('lakban_id');
            $table->string('lakban2_id')->nullable();

            $table->integer('counter_filling')->nullable();
            $table->integer('counter_coding')->nullable();
            $table->integer('counter_label')->nullable();

            $table->integer('masuk_cap')->nullable();
            $table->integer('pakai_cap')->nullable();
            $table->integer('saldo_cap')->nullable();

            $table->float('saldo_label')->nullable();
            $table->float('masuk_label')->nullable();
            $table->float('pakai_label')->nullable();
            $table->integer('conversi_label')->nullable();

            $table->integer('saldo_karton')->nullable();
            $table->integer('masuk_karton')->nullable();
            $table->integer('terpakai_karton')->nullable();
            $table->integer('reject_karton')->nullable();

            $table->integer('saldo_lakban')->nullable();
            $table->integer('masuk_lakban')->nullable();
            $table->integer('terpakai_lakban')->nullable();
            $table->integer('reject_lakban')->nullable();

            $table->integer('saldo_lakban2')->nullable();
            $table->integer('masuk_lakban2')->nullable();
            $table->integer('terpakai_lakban2')->nullable();
            $table->integer('reject_lakban2')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varians');
    }
};
