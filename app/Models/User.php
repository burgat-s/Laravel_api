<?php

namespace App\Models;

use App\Entities\Eloquent\Organismo;
use App\Notifications\ResetPasswordNotification as ResetNotify;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, CanResetPass;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin',
        'username',
        'nombre',
        'apellido',
        'dni',
        'email',
        'telefono',
        'sexo',
        'token',
        'fecha_verificacion',
        'password',
        'organismo_id',
        'refresh_pass_token',
        'refresh_pass_created_at',
        'refresh_pass_last_updated_at',
        'failed_attempts'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
        'created_at',
        'updated_at',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_verificacion' => 'datetime',
        'admin' => 'integer',
        'organismo_id' => 'integer',
    ];

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return false;
    }

    public function setRememberToken($value)
    {
        return false;
    }

    public function getRememberTokenName()
    {
        return true;
    }

    public function can($permiso, $arguments = [])
    {
        return $this->hasPermissionTo($permiso,'api');
    }

    public function isAdmin()
    {
        return $this->hasRole("admin");
    }

    public function islogged($userID)
    {
        return Auth::user()->id == $userID;
    }

    public function tieneClave()
    {
        return $this->password !== null;
    }

    public function puedeSubirArchivosExternos()
    {
        if($this->isAdmin()) return true;

        return $this->organismo->puedeSubirArchivos();
    }

    public function organismo()
    {
        return $this->belongsTo(Organismo::class);
    }

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetNotify($token));
    }
}
