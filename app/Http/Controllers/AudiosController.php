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
 
        $validator = Validator::make($request->file(), [
            'sonido' => 'required|mimes:mpga,mp3,mp4,wav,mid'
                ]);

        if($validator->fails()){
            var_dump($validator->errors());
            return "mal";
            return redirect()->back()->withErrors($validator);
        }
        else {
            $request->file('documento')->storeAs('public');
            $ListaAudios = DB::table('audios')->where('id_usuario', 1)->get();
            return view('index', compact('ListaAudios'));
            $documento->nombre_inicial = $request->file('documento')->getClientOriginalName();
        }

    }
}
