<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use \App\Traits\LogsActivity, HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Helper method untuk mengambil nilai setting berdasarkan key.
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        return $setting && ! is_null($setting->value) ? $setting->value : $default;
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
