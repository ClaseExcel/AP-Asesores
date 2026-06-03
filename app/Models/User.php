<?php

namespace App\Models;

use App\Http\Controllers\Traits\ActionButtonTrait;
use \DateTimeInterface;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;

    public $table = 'users';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'role_id',
        'cargo_id',
        'cedula',
        'nombres',
        'apellidos',
        'email',
        'tarje_profesional',
        'firma',
        'numero_contacto',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at',
        'direccion',
        'barrio',
        'tipo_identificacion',
        'fecha_nacimiento',       
        'fecha_contrato',
        'fecha_ingreso',
        'fecha_retiro',
        'tipo_salario',
        'salario',
        'tipo_contrato',
        'EPS',
        'fondo_pension',
        'caja_compensacion',
        'nivel_riesgo',
        'funeraria',
        'contrasena_eps',
        'documento_examen',
        'documento_afiliacion',
        'documento_contrato',
        'documento_otros',
        'cesantias',
        'beneficiario',
        'informacion_beneficiario',
        //
        'lugar_nacimiento',
        'nacionalidad',
        'fecha_fin_contrato'
    ];
    
    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function empleadoCliente()
    {
        return $this->hasOne(EmpleadoCliente::class, 'user_id');
    }
}
