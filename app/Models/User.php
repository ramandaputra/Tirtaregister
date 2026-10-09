<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, \App\Traits\LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Accessor untuk mendapatkan label nama role (Spatie Permission)
     */
    public function getRoleLabelAttribute(): string
    {
        // Mengambil nama role pertama yang dimiliki user
        $primaryRole = $this->roles->first()?->name;

        return match ($primaryRole) {
            'superadmin' => 'Super Admin',
            'admin'      => 'Admin',
            default      => $primaryRole ? ucfirst($primaryRole) : 'Admin',
        };
    }
}