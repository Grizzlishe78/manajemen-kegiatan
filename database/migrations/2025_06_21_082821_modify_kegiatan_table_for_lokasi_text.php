<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropForeign(['lokasi_id']);
            
            $table->dropColumn('lokasi_id');
            
            $table->string('nama_lokasi')->after('organisasi_id');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatan', function (Blueprint $table) {
            $table->dropColumn('nama_lokasi');
            $table->foreignId('lokasi_id')->constrained('lokasi')->onDelete('cascade');
        });
    }
};