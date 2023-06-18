<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apotek extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'apoteks';

    protected $fillable = [ 
        'nama',
        'rujukan',
        'rumah_sakit',
        'obat',
        'harga_satuan',
        'total_harga',
        'apoteker',
    ];

    protected $casts = [ 
        'obat' => 'array',
        'harga_satuan' => 'array',
    ];
}
