<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminpe extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */

    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_SELESAI = 'selesai';

    protected $fillable = [
        'NIM',
        'pengaduan',
        'foto',
        'status',
        'tanggal',
    ];
}
