<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduans';
    /**
     * fillable
     *
     * @var array
     */

    public const STATUS_DIPROSES = 'Diproses';
    public const STATUS_MENUNGGU = 'Menunggu';
    public const STATUS_SELESAI = 'Selesai';

    public $timestamps = false;

    protected $fillable = [
        'p_nim',
        'pengaduan',
        'foto',
        'status',
        'tanggal',
    ];
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'p_nim', 'nim');
    }
}
