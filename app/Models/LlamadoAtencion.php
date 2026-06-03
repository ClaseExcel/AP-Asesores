<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlamadoAtencion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'asunto',
        'medidas',
        'consecutivo',
        'evidencia',
        'url_documento',
        'empleado_id',
    ];

    protected $table = 'llamados_atencion';

    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
    }

}
