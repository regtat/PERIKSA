<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MahasiswaModel extends Model
{
    use HasFactory;
    protected $table='mahasiswa';
    protected $primaryKey='nim';
    public $incrementing=false; //pk bln int auto increment
    protected $keyType='string';
    protected $fillable=[
        'nim',
        'nama',
    ];

    public function user(): HasOne{
        return $this->hasOne(User::class, 'nim','nim');
    }
}
