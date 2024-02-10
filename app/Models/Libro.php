<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Libro extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titolo',
        'autore',
        'codice_isbn',
        'trama',
        'numero_di_letture_complete',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected static function booted()
    {
        static::creating(function ($libro) {
            $libro->user_id = auth()->id();
            $libro->created_at = now();
        });

        static::updating(function ($libro) {
            $libro->updated_at = now();
        });

        static::deleting(function ($libro) {
            $libro->deleted_at = now();
            $libro->save();
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
