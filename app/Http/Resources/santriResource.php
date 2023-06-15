<?php

namespace App\Http\Resources;

use App\Models\lembagaModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class santriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_santri' => $this->nama_santri,
            'nama_ayah' => $this->nama_ayah,
            'ttl' => $this->ttl,
            'alamat' => $this->alamat,
            'jilid' => $this->jilid,
            'pend_terakhir' => $this->pend_terakhir,
            'lembaga' => lembagaModel::find($this->id_lembaga)->nama,
            'telp_wali' => $this->telp_wali,
            'kode_provinsi' => $this->kode_provinsi,
            'kode_kabupaten' => $this->kode_kabupaten,
            'kode_kecamatan' => $this->kode_kecamatan,
            'kode_kelurahan' => $this->kode_kelurahan,
            'provinsi' => $this->provinsi->nama_wilayah,
            'kabupaten' => $this->kabupaten->nama_wilayah,
            'kecamatan' => $this->kecamatan->nama_wilayah,
            'kelurahan' => $this->kelurahan->nama_wilayah,
        ];
    }
}
