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

    /**
     * Ambil daftar kontak cabang WhatsApp beserta contact person.
     * Mengembalikan array of ['branch' => string, 'name' => string, 'wa' => string]
     *
     * @return array<int, array{branch: string, name: string, wa: string}>
     */
    public static function getBranchContacts(): array
    {
        try {
            $raw = static::where('key', 'branch_contacts')->value('value');
            if ($raw) {
                $decoded = is_array($raw) ? $raw : json_decode($raw, true);
                if (is_array($decoded) && count($decoded) > 0) {
                    $clean = [];
                    foreach ($decoded as $item) {
                        if (is_array($item) && (! empty($item['branch']) || ! empty($item['wa']))) {
                            $clean[] = [
                                'branch' => trim($item['branch'] ?? ''),
                                'name' => trim($item['name'] ?? ''),
                                'wa' => trim($item['wa'] ?? ''),
                            ];
                        }
                    }
                    if (! empty($clean)) {
                        return $clean;
                    }
                }
            }

            // Fallback ke legacy branch_1, branch_2, branch_3 dengan parsing nama jika ada "(Nama)"
            $all = static::pluck('value', 'key')->toArray();

            $parseLegacy = function ($branchName, $waVal, $defaultBranch, $defaultWa) {
                $branch = ! empty($branchName) ? $branchName : $defaultBranch;
                $waString = ! empty($waVal) ? $waVal : $defaultWa;
                $name = '';

                if (preg_match('/^(.*?)\s*\((.*?)\)$/', $waString, $matches)) {
                    $wa = trim($matches[1]);
                    $name = trim($matches[2]);
                } else {
                    $wa = $waString;
                }

                return [
                    'branch' => $branch,
                    'name' => $name,
                    'wa' => $wa,
                ];
            };

            $c1 = $parseLegacy($all['branch_1_name'] ?? null, $all['branch_1_wa'] ?? null, 'Tanjungpinang', '0811-778-2155');
            $c2 = $parseLegacy($all['branch_2_name'] ?? null, $all['branch_2_wa'] ?? null, 'Kijang', '0812-345-6789');
            $c3 = $parseLegacy($all['branch_3_name'] ?? null, $all['branch_3_wa'] ?? null, 'Tanjung Uban', '0813-456-7890');

            return array_values(array_filter([$c1, $c2, $c3], fn ($c) => ! empty($c['wa'])));
        } catch (\Throwable $e) {
            return [
                ['branch' => 'Tanjungpinang', 'name' => '', 'wa' => '0811-778-2155'],
                ['branch' => 'Kijang', 'name' => '', 'wa' => '0812-345-6789'],
                ['branch' => 'Tanjung Uban', 'name' => '', 'wa' => '0813-456-7890'],
            ];
        }
    }
}
