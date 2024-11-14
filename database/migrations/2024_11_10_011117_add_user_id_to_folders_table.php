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
        Schema::table('folders', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menambahkan kolom user_id dengan relasi ke tabel users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Menghapus relasi foreign key
            $table->dropColumn('user_id');    // Menghapus kolom user_id
        });
    }
};
