<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lembagaModel extends Model
{
    use HasFactory;
    protected $table = 'lembaga';
    protected $guarded = [''];

    public function provinsi()
    {
        return $this->belongsTo(wilayahModel::class, 'kode_provinsi', 'kode');
    }

    public function kabupaten()
    {
        return $this->belongsTo(wilayahModel::class, 'kode_kabupaten', 'kode');
    }
    public function kecamatan()
    {
        return $this->belongsTo(wilayahModel::class, 'kode_kecamatan', 'kode');
    }
    public function kelurahan()
    {
        return $this->belongsTo(wilayahModel::class, 'kode_kelurahan', 'kode');
    }
}
