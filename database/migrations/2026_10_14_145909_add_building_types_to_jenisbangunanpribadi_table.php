<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('jenisbangunanpribadi')) {
            $newTypes = [
                ['jenis' => 'KONTRAKAN', 'kodegol' => 'IIA'],
                ['jenis' => 'KOS', 'kodegol' => 'IIA'],
                ['jenis' => 'WARUNG/KEDAI/KIOS', 'kodegol' => 'IIA'],
            ];

            foreach ($newTypes as $type) {
                $exists = DB::table('jenisbangunanpribadi')
                    ->whereRaw('UPPER(jenis) = ?', [$type['jenis']])
                    ->exists();

                if (! $exists) {
                    DB::table('jenisbangunanpribadi')->insert($type);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('jenisbangunanpribadi')) {
            DB::table('jenisbangunanpribadi')
                ->whereIn('jenis', ['KONTRAKAN', 'KOS', 'WARUNG/KEDAI/KIOS'])
                ->delete();
        }
    }
};
