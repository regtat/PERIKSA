<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false; //pk bln int auto increment
    protected $keyType = 'string';
    protected $fillable = [
        'nim',
        'nama',
    ];

    //relasi one to many
    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class, 'p_nim', 'nim');
    }
    public function kritiksaran(): HasMany
    {
        return $this->hasMany(Kritiksaran::class, 'p_nim', 'nim');
    }

}
