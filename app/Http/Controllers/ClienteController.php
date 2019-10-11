<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\ContatoCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'razaoSocial' => 'required',
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
        $clientes = Cliente::all();
        return view('cliente.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $cliente = new Cliente();
        $cliente->razaoSocial = $request->razaoSocial;
        $cliente->bolAtivo = $request->ativo;
        $cliente->save();

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $id_cliente = $cliente->id;
        $contatos = ContatoCliente::where('idCliente',$id_cliente)->get();
        // dd($contatos);
        return view('cliente.edit',compact('cliente','contatos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();   
        $cliente = Cliente::findOrFail($id);
        $cliente->razaoSocial = $request->razaoSocial;
        $cliente->bolAtivo = $request->ativo;
        $cliente->save();

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json();    
    }
}
