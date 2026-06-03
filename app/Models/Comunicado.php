<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;

    protected $fillable = [
        'clientes',
        'comunicado',
        'documento_uno',
        'documento_dos',
        'correos_enviados',
        'user_id',
        'usuarios',
    ];
    
    protected $table = 'comunicados';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
