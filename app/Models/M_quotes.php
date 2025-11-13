<?php

namespace App\Models;

use App\Models\M_acara;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class M_quotes extends Model
{
    use HasUuids;
    
    protected $table = 'mt_quotes';
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

    // Scope untuk quote yang ditampilkan di halaman utama
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope untuk jenis quote tertentu
    public function scopeJenis($query, $jenis)
    {
        return $query->where('jenis_quote', $jenis);
    }
}
