<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Resources\ClienteResource;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados =  ClienteResource::collection(Cliente::orderBy('nome')->get());
        return response()->json($dados, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nome' => "required",
            'id_cidade' => 'required'
        ],$this->mensagens());

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $registro = Cliente::create($request->all());
        return response()->json(new ClienteResource($registro), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return new ClienteResource($cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validator = Validator::make($request->all(), [
            'nome' => "required",
            'id_cidade' => 'required'
        ],$this->mensagens());

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $cliente->fill($request->all());
        $cliente->save();


        return response()->json(new ClienteResource($cliente), 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {

        $cliente->delete();
        return response()->json(['success'=>'Cliente excluído com sucesso'],200);
    }

    private function mensagens(){
       return [
            'nome.required' => 'Nome do cliente é obrigatório',
            'id_cidade.required' => 'Cidade é um campo obrigatório'
          ];

    }
}
