<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::all();
        return $clients;

    }

    public function store(Request $request){

        try {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|unique:clients|max:255',
            'date_birth' => 'string',
            'cpf' => 'string|unique:clients',
            'adress' => 'string'
        ]);

        $data = $request->all();

        $client = Client::create($data);

        return $client;

    } catch (\Exception $exception){
        return response()->json(['message' => $exception->getMessage()], 400);
    }

    }

    public function update($id, Request $request){

        try{

            $client = Client::find($id);

            if(!$client){
                return response()->json(['message' => 'Cliente não foi encontrado'], 404);
            }

            $client->update($request->all());


        } catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 400);
        }

    }

    public function destroy($id){
        $client = Client::find($id);

        if(!$client){
            return response()->json(['message' => 'Cliente não foi encontrado'], 404);
        }

        $client->delete();

        return response(['message' => 'Id excluído com sucesso'], 204);

    }
}
