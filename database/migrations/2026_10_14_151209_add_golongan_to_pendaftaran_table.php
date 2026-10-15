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
        if (Schema::hasTable('pendaftaran')) {
            if (! Schema::hasColumn('pendaftaran', 'golongan')) {
                Schema::table('pendaftaran', function (Blueprint $table) {
                    $table->string('golongan', 20)->nullable()->after('tipe');
                });
            }

            // Backfill existing rows
            DB::table('pendaftaran')
                ->whereNull('golongan')
                ->where('tipe', 'REGULER')
                ->update(['golongan' => 'IIA']);

            DB::table('pendaftaran')
                ->whereNull('golongan')
                ->where('tipe', '!=', 'REGULER')
                ->update(['golongan' => 'IB']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pendaftaran') && Schema::hasColumn('pendaftaran', 'golongan')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropColumn('golongan');
            });
        }
    }
};
