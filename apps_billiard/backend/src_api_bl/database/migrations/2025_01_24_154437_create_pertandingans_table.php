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
        Schema::create('pertandingans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_a_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('client_b_id')->constrained('clients')->onDelete('cascade');
            $table->string('category');
            $table->datetime('start_time')->nullable();
            $table->integer('skor_a')->default('0');
            $table->integer('skor_b')->default('0');
            $table->enum('status', ['Belum Dimulai', 'Berlangsung', 'Selesai'])->default('Belum Dimulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertandingans');
    }
};
