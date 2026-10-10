<?php

namespace App\Traits;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $name = $model->name ?? $model->title ?? $model->key ?? $model->id;
            logActivity('Create', 'Menambahkan data '.class_basename($model).': '.$name, class_basename($model), $model->id);
        });

        static::updated(function ($model) {
            $name = $model->name ?? $model->title ?? $model->key ?? $model->id;
            logActivity('Update', 'Mengubah data '.class_basename($model).': '.$name, class_basename($model), $model->id);
        });

        static::deleted(function ($model) {
            $name = $model->name ?? $model->title ?? $model->key ?? $model->id;
            logActivity('Delete', 'Menghapus data '.class_basename($model).': '.$name, class_basename($model), $model->id);
        });
    }
}
