<?php

namespace App\Http\Resources;

use App\Models\Cidade;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cidade' => new CidadeResource(Cidade::find($this->id_cidade)),
        ];
    }
}
