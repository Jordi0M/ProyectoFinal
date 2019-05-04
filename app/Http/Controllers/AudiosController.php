<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\audios;

class AudiosController extends Controller
{
    public function index(){
        $ListaAudios = DB::table('audios')->where('id_usuario', 1)->get();
        return view('index', compact('ListaAudios'));
    }

    public function nuevoSonido(Request $request){
        //return dd($request->all());
        /*
        if($request->hasFile('sonido')){
            return "lo tiene";
        }
        else {
            return "noper";
        }
        */////////////pruebas
        $validator = Validator::make($request->all(), [
            'sonido' => 'required|file|mimes:mp3,mp4,wav,mid',
                ]);

        if($validator->fails()){
            return "mal";
            return redirect()->back()->withErrors($validator);
        }
        else {
            return "bien";
        }

    }
}
