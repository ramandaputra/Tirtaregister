<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Helper method untuk mengambil nilai setting berdasarkan key.
     */
    /**
     * Helper method untuk mengambil seluruh setting sebagai associative array [key => value].
     */
    public static function allKeyValues(): array
    {
        try {
            return static::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function get(string $key, $default = null)
    {
        try {
            $setting = static::where('key', $key)->first();

            return $setting && ! is_null($setting->value) ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Helper method untuk menyimpan/mengupdate nilai setting berdasarkan key.
     */
    public static function set(string $key, $value, string $group = 'general'): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }
}
