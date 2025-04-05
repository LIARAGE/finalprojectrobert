<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'faktur_id',
        'nama_barang',
        'harga',
        'qty',
        'subtotal',
    ];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class);
    }
}