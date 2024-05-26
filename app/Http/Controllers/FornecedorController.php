<?php

namespace App\Http\Controllers;


class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedor = ['Fornecedor 1'];


        return view('fornecedor', compact('fornecedor'));
    }
}
