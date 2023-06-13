<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class lembagaResource extends JsonResource
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
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'status' => $this->status,
            'no_hp' => $this->no_hp,
            'no_nsl' => $this->no_nsl,
            'no_npl' => $this->no_npl,
            'jml_guru' => $this->jml_guru,
            'jml_santri' => $this->jml_santri,
            'provinsi' => $this->provinsi->nama_wilayah,
            'kabupaten' => $this->kabupaten->nama_wilayah,
            'kecamatan' => $this->kecamatan->nama_wilayah,
            'kelurahan' => $this->kelurahan->nama_wilayah,
            'kode_pos' => $this->kode_pos
        ];
    }
}
