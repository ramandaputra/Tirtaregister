<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('connection_requests', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // No. Pendaftaran unik (misal: REG-202610-001)
            $table->string('full_name');
            $table->string('nik', 16);
            $table->string('phone_number');
            $table->text('installation_address');
            $table->string('ktp_file_path'); // Path penyimpanan berkas KTP
            $table->string('status')->default('pending'); // pending, survey, approved, rejected
            $table->text('notes')->nullable(); // Catatan dari admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('connection_requests');
    }
};
