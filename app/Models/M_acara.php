<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class M_acara extends Model
{
    use HasUuids;
    
    protected $table = 'mt_acara';
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

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Detail Acara
    public function detail_acara()
    {
        return $this->hasMany(M_detail_acara::class, 'acara_id');
    }

    // Relasi ke Orang Tua
    public function orang_tua()
    {
        return $this->hasMany(M_orang_tua::class, 'acara_id');
    }

    // Relasi ke Galeri
    public function galeri()
    {
        return $this->hasMany(M_galeri::class, 'acara_id');
    }

    // Relasi ke Rekening
    public function rekening()
    {
        return $this->hasMany(M_rekening::class, 'acara_id');
    }

    // Relasi ke Tamu
    public function tamu()
    {
        return $this->hasMany(M_tamu::class, 'acara_id');
    }

    // Relasi ke Love Story
    public function love_story()
    {
        return $this->hasMany(M_love_story::class, 'acara_id');
    }

    // Relasi ke Quotes
    public function quotes()
    {
        return $this->hasMany(M_quotes::class, 'acara_id');
    }

    // Scope untuk mengambil data mempelai pria
    public function scopeMempelaiPria($query)
    {
        return $query->with(['orang_tua' => function($q) {
            $q->where('jenis_orang_tua', 'MEMPELAI_PRIA');
        }]);
    }

    // Scope untuk mengambil data mempelai wanita
    public function scopeMempelaiWanita($query)
    {
        return $query->with(['orang_tua' => function($q) {
            $q->where('jenis_orang_tua', 'MEMPELAI_WANITA');
        }]);
    }
}
