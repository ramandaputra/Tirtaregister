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
        Schema::table('connection_requests', function (Blueprint $table) {
            // Drop foreign key constraints that still exist
            $table->dropForeign(['village_id']);
            $table->dropForeign(['rayon_id']);
            $table->dropForeign(['purpose_id']);

            // Change column types to string
            $table->string('building_type_id')->nullable()->change();
            $table->string('ownership_id')->nullable()->change();
            $table->string('facility_type_id')->nullable()->change();
            $table->string('village_id')->nullable()->change();
            $table->string('rayon_id')->nullable()->change();
            $table->string('purpose_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('connection_requests', function (Blueprint $table) {
            //
        });
    }
};
