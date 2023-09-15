<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ClienteController{


    public function testConnection()
    {
    try {
        DB::connection()->getPdo();
        return 'Conexão com o banco de dados estabelecida com sucesso!';
    } catch (\Exception $e) {
        return 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
    }
    }

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function store(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            'nome' => 'required|min:6',
            'email' => 'required|email|unique:tbl_cliente',
            'senha' => 'required|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $cliente = new Cliente();
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->senha = Hash::make($request->input('senha'));
        $cliente->save();
    
        return response()->json(['message' => 'Cliente registrado com sucesso'], 201);
    }
    

    public function show($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            return response()->json($cliente);
        } else {
            return response()->json(['error' => 'Cliente não encontrado.'], 404);
        }
    }
    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');
        $email=$request->email;
        $password = $request->password;

        if(empty($email) or empty($password)){
            return response()->json(['status'=> 'erro', 'message'=> 'Faltou informação de entrada']);
        }

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

