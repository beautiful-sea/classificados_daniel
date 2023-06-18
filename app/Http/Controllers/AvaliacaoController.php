<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        $anunciante_avaliado = \App\Models\Anunciante::where('slug', $slug)->firstOrFail();
        return view('avaliacao')->with('anunciante_avaliado', $anunciante_avaliado->user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        /**
         *  nome: this.nome,
         * email: this.email,
         * whatsapp: this.whatsapp,
         * campoAvaliacoes: this.campoAvaliacoes,
         * anunciante_id : this.anunciante_avaliado.anunciante.id
         */

        //Valida
        $request->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'whatsapp' => 'required',
            'campoAvaliacoes' => 'required',
            'comentario'    => 'nullable',
            'anunciante_id' => 'required',
        ],
            [
                'nome.required' => 'O campo nome é obrigatório',
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O campo email deve ser um email válido',
                'whatsapp.required' => 'O campo whatsapp é obrigatório',
                'campoAvaliacoes.required' => 'É necessário preencher as avaliações',
                'anunciante_id.required' => 'Profissional não encontrado',
            ]);

        //Não é possivel avaliar se o email da pessoa for um email de anunciante cadastrado
        if(\App\Models\User::where('email', $request->email)->where('role' ,'anunciante')->first()){
            return response()->json(['errors' => [['Profissionais não podem avaliar outros profissionais']]], 422);
        }

        try{
            //Salva a avaliação
            $avaliacao = new \App\Models\Avaliacao();
            $avaliacao->nome = $request->nome;
            $avaliacao->email = $request->email;
            $avaliacao->whatsapp = $request->whatsapp;
            $avaliacao->anunciante_id = $request->anunciante_id;
            $avaliacao->anunciante_id = $request->anunciante_id;
            $avaliacao->comentario = $request->comentario;
            $avaliacao->save();

            //Salva os campos de avaliação
            foreach ($request->campoAvaliacoes as $campoAvaliacao) {
                $campo_avaliacao = new \App\Models\AvaliacaoCampo();
                $campo_avaliacao->avaliacao_id = $avaliacao->id;
                $campo_avaliacao->campo_avaliacao_id = $campoAvaliacao['id'];
                $campo_avaliacao->nota = $campoAvaliacao['nota'];
                $campo_avaliacao->save();
            }

            return response()->json(['success' => 'Avaliação salva com sucesso'], 200);
        } catch (\Exception $e){
            return response()->json(['error' => 'Erro ao salvar avaliação', 'trace'=>$e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(  Request $request, $anunciante_id, $avaliacao_id)
    {
        try{
            $avaliacao = \App\Models\Avaliacao::where('id', $avaliacao_id)->where('anunciante_id', $anunciante_id)->firstOrFail();
            //Exclui os campos de avaliação
            foreach ($avaliacao->avaliacao_campos as $campo) {
                $campo->delete();
            }
            $avaliacao->delete();
            return response()->json(['success' => 'Avaliação excluída com sucesso'], 200);
        } catch (\Exception $e){
            return response()->json(['error' => 'Erro ao excluir avaliação', 'trace'=>$e->getMessage()], 500);
        }
    }
}
