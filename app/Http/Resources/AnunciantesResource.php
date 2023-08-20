<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnunciantesResource extends ResourceCollection
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $next_page = $this->currentPage() + 1;
        if($next_page > $this->lastPage()){
            $next_page = $this->currentPage();
        }
        return [
            'data' => $this->collection->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'titulo' => $item->titulo,
                    'slug' => $item->slug,
                    'descricao' => $item->descricao,
                    'valor_hora' => $item->valor_hora?(double)$item->valor_hora:0.0,
                    'foto_principal' => $item->foto_principal ? asset('storage/' . $item->foto_principal) : asset('images/avatar.webp'),
                    //formato 0.00 de duas casas decimais
                    'media_avaliacoes'=> number_format($item->media_avaliacoes,2),
                    'total_avaliacoes'=>$item->total_avaliacoes,
                    'user'  => [
                        'id' => $item->user->id,
                        'name' => $item->user->name,
                        'email' => $item->user->email,
                        'photo_path' => $item->user->photo_path,
                        'phone' => $item->user->phone,
                        'role' => $item->user->role,
                        ],

                    'categoria' => [
                            'id' => $item->categoria->id,
                            'nome' => $item->categoria->nome,
                            'categoria_pai_id' => $item->categoria->categoria_pai_id,
                        ],
                    'endereco' => [
                            'id' => $item->endereco->id,
                            'cep' => $item->endereco->cep,
                            'logradouro' => $item->endereco->logradouro,
                            'cidade' => [
                                'id' => $item->endereco->cidade->id,
                                'nome' => $item->endereco->cidade->nome,
                                'estado' => [
                                    'id' => $item->endereco->estado->id,
                                    'nome' => $item->endereco->estado->nome,
                                    'sigla' => $item->endereco->estado->sigla,
                                ],
                            ],

                            'lat'   => (double)$item->endereco->lat,
                            'lng'   => (double)$item->endereco->lng,
                        ],
                    'agendamentos'  => $item->agendamentos()->where('status','disponivel')
                        ->whereDate('data','>',date('Y-m-d'))
                        ->get(),
                    ];
            }),
            'links' => [
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
                'next_page' =>$next_page
            ],
        ];
    }
}
