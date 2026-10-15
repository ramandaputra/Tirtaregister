<?php

use App\Models\ActivityLog;
use App\Models\Setting;

if (! function_exists('setting')) {
    /**
     * Ambil nilai dari tabel settings berdasarkan key.
     *
     * @param  mixed  $default
     * @return mixed
     */
    function setting(?string $key = null, $default = null)
    {
        if (is_null($key)) {
            return new Setting;
        }

        return Setting::get($key, $default);
    }
}

if (! function_exists('logActivity')) {
    /**
     * Catat aktivitas log.
     *
     * @param  string  $action
     * @param  string  $description
     * @param  string|null  $modelType
     * @param  int|null  $modelId
     * @return void
     */
    function logActivity($action, $description, $modelType = null, $modelId = null)
    {
        $ipAddress = request()->header('X-Forwarded-For')
                        ? trim(explode(',', request()->header('X-Forwarded-For'))[0])
                        : (request()->header('Client-Ip')
                            ? request()->header('Client-Ip')
                            : request()->ip());

        ActivityLog::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $description,
            'ip_address' => $ipAddress,
        ]);
    }
}

if (! function_exists('format_wa_url')) {
    /**
     * Format nomor WhatsApp menjadi link wa.me yang valid internasional.
     */
    function format_wa_url(?string $phone, ?string $message = null): string
    {
        $clean = preg_replace('/[^0-9]/', '', (string) $phone);
        if (str_starts_with($clean, '0')) {
            $clean = '62'.substr($clean, 1);
        }

        $url = 'https://wa.me/'.$clean;
        if (! empty($message)) {
            $url .= '?text='.urlencode($message);
        }

        return $url;
    }
}

if (! function_exists('branch_contacts')) {
    /**
     * Ambil daftar kontak cabang WhatsApp.
     *
     * @return array<int, array{branch: string, name: string, wa: string}>
     */
    function branch_contacts(): array
    {
        return Setting::getBranchContacts();
    }
}
