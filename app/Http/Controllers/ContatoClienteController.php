<?php

namespace App\Http\Controllers;

use App\ContatoCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContatoClienteController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tipoContato' => 'required',
            'contato' => 'required',
            'ativo' => 'required',            
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();   
        $contato = new ContatoCliente();
        $contato->idCliente = $request->id;
        $contato->ativo = $request->ativo;
        $contato->tipoContato = $request->tipoContato;
        $contato->descContato = $request->contato;
        $contato->save();

        return response()->json();    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContatoCliente  $contatoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(ContatoCliente $contatoCliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContatoCliente  $contatoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(ContatoCliente $contatoCliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContatoCliente  $contatoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();   
        $contato = ContatoCliente::findOrFail($id);
        $contato->idCliente = $request->idCliente;
        $contato->ativo = $request->ativo;
        $contato->tipoContato = $request->tipoContato;
        $contato->descContato = $request->contato;
        $contato->save();

        return response()->json();      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContatoCliente  $contatoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contato = ContatoCliente::findOrFail($id);
        $contato->delete();

        return response()->json();     }
}
