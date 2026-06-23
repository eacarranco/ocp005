<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnvioLog extends Model
{
    protected $table = 'envio_logs';
    
    protected $fillable = [
        'numero_lote',
        'timestamp_generacion',
        'valor_total',
        'total_registros',
        'filename',
        'tipo_envio',
    ];

    protected $casts = [
        'timestamp_generacion' => 'datetime',
        'valor_total' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
                $model->updated_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function cobros()
    {
        return $this->hasMany(CobroPacifico::class, 'envio_logs_id');
    }
}