<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index(Request $request){

        $lista = Cidade::where(Str::upper('nome'),'like',   '%'.Str::upper($request['cidade'].'%'))->get();
        return response()->json($lista,200);
    }
}
