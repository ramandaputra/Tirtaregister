<?php

use App\Models\User;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
        });

        $users = User::all();
        foreach ($users as $user) {
            if (empty($user->username)) {
                $baseUsername = strtolower(explode('@', $user->email)[0]);
                $candidate = $baseUsername;
                $counter = 1;
                while (User::where('username', $candidate)->where('id', '!=', $user->id)->exists()) {
                    $candidate = $baseUsername.$counter;
                    $counter++;
                }
                $user->username = $candidate;
                $user->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
