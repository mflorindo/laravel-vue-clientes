<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Cliente;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $dados = [];
        $dados['clientes'] = Cliente::count();
        $dados['cidades'] = Cidade::count();

        return response()->json($dados, 200);
    }
}
