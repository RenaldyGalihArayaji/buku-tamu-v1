<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class M_tamu extends Model
{
    use HasUuids;
    
    protected $table = 'mt_tamu';
    protected $guarded = ['id'];
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });
    }

    public function acara()
    {
        return $this->belongsTo(M_acara::class, 'acara_id');
    }

    // Scope untuk tamu yang sudah konfirmasi
    public function scopeKonfirmasi($query)
    {
        return $query->where('konfirmasi_kehadiran', true);
    }

    // Scope untuk tamu yang sudah hadir
    public function scopeHadir($query)
    {
        return $query->where('status_kehadiran', 'HADIR');
    }

    // Scope untuk tamu berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori_tamu', $kategori);
    }
}
