<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WD extends Model
{
    use HasFactory;
    protected $table = 'wd';
    protected $primaryKey = 'nip';
    //public $incrementing=false; //pk bln int auto increment
    protected $keyType = 'string';
    protected $fillable = [
        'nip',
        'nama',
    ];

}
