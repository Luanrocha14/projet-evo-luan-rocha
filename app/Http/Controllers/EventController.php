<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $nome = "Luan";
        $idade = "22";

        $arr = [10, 20, 30, 40, 100];

        $nomes = ["Matheus", "Maria", "João", "Saulo"];

        return view(
            'welcome',
            [
                'nome' => $nome,
                'idade' => $idade,
                'arr' => $arr,
                "nomes" => $nomes,

            ]
        );
    }

    public function create()
{
    return view('events.create');
}

}
