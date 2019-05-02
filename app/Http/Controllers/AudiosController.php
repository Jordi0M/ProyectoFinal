<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\audios;

class AudiosController extends Controller
{
    public function index(){
        $ListaAudios = DB::table('audios')->where('id_usuario', 1)->get();
        return view('index', compact('ListaAudios'));
    }
}
