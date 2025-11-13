<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class M_love_story extends Model
{
    use HasUuids;
    
    protected $table = 'mt_love_story';
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

    // Scope untuk mengurutkan berdasarkan tanggal kejadian
    public function scopeKronologis($query)
    {
        return $query->orderBy('tanggal_kejadian', 'asc');
    }

    // Scope untuk milestone tertentu
    public function scopeMilestone($query, $milestone)
    {
        return $query->where('milestone', $milestone);
    }
}
