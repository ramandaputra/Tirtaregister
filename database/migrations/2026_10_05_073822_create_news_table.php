<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('news', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('category')->default('Informasi');
        $table->text('excerpt')->nullable();
        $table->longText('content');
        $table->string('image')->nullable();
        $table->boolean('is_published')->default(true);
        $table->timestamps();
    });
}
};
