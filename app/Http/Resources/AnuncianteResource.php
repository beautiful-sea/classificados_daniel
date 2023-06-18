<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnuncianteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'descricao' => $this->descricao,
            'valor_hora' => $this->valor_hora?(double)$this->valor_hora:0.0,
            'foto_principal' => $this->foto_principal ? asset('storage/' . $this->foto_principal) : asset('images/avatar.webp'),
            'categoria' => [
                'id' => $this->categoria->id,
                'nome' => $this->categoria->nome,
                'categoria_pai_id' => $this->categoria->categoria_pai_id,
            ],
            'endereco' => [
                'id' => $this->endereco->id,
                'cep' => $this->endereco->cep,
                'logradouro' => $this->endereco->logradouro,
                'cidade' => [
                    'id' => $this->endereco->cidade->id,
                    'nome' => $this->endereco->cidade->nome,
                    'estado' => [
                        'id' => $this->endereco->estado->id,
                        'nome' => $this->endereco->estado->nome,
                        'sigla' => $this->endereco->estado->sigla,
                    ],
                ],

                'lat'   => (double)$this->endereco->lat,
                'lng'   => (double)$this->endereco->lng,
            ]
        ];
    }
}
