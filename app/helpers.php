<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Ambil nilai dari tabel settings berdasarkan key.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function setting(?string $key = null, $default = null)
    {
        if (is_null($key)) {
            return new Setting();
        }

        return Setting::get($key, $default);
    }
}

if (!function_exists('logActivity')) {
    /**
     * Catat aktivitas log.
     *
     * @param string $action
     * @param string $description
     * @param string|null $modelType
     * @param int|null $modelId
     * @return void
     */
    function logActivity($action, $description, $modelType = null, $modelId = null)
    {
        \App\Models\ActivityLog::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
}