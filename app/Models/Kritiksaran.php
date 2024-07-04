<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kritiksaran extends Model
{
    use HasFactory;
    protected $table = 'kritiksarans';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'k_nim',
        // 'nama',
        'kritiksaran',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}