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

    public function index_auntenticado($id = 1){
        $ListaAudios = DB::table('audios')->where('id_usuario', 1)->orWhere('id_usuario', $id)->get();
        return view('index', compact('ListaAudios'));
    }

    public function nuevoSonido(Request $request, $id){
 
        $validator = Validator::make($request->file(), [
            'sonido' => 'required|mimes:mpga,mp3,mp4,wav,mid'
                ]);

        if($validator->fails()){
            var_dump($validator->errors());
            return "mal";
            return redirect()->back()->withErrors($validator);
        }
        else {        
            $sonido_a_almacenar = $request->file('sonido');
            $sonido = new audios;

            $sonido->id_usuario = $id;
            $sonido->nombre_original = $sonido_a_almacenar->getClientOriginalName();
            $sonido->nombre_link = $sonido_a_almacenar->store('public');
            $sonido->nombre_mostrar = $request->input('nuevo_nombre_del_sonido');;
            $sonido->save();
            return $this->index_auntenticado($id);

            //->storeAs('public');
            $ListaAudios = DB::table('audios')->where('id_usuario', 1)->get();
            return view('index', compact('ListaAudios'));
            $documento->nombre_inicial = $request->file('documento')->getClientOriginalName();
        }

    }
}
