<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests\NuevoSonidoRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\audios;
use Auth;

class AudiosController extends Controller
{
    public function index(){
        if (Auth::user()) {
            $ListaAudios = DB::table('audios')->where('id_usuario', 1)->orWhere('id_usuario', Auth::user()->id)->get();
            $NumeroPistas = $ListaAudios->count();
            return view('index', compact('ListaAudios', 'NumeroPistas'));
        }
        else{
            $ListaAudios = DB::table('audios')->where('id_usuario', 1)->get();
            $NumeroPistas = $ListaAudios->count();
            return view('index', compact('ListaAudios', 'NumeroPistas'));
        }
       
    }

    public function nuevoSonido(NuevoSonidoRequest $request, $id){

        if ($request->ajax()) {
      
            return response()->json($request->all());
            /*
            $validator = Validator::make($request->all(), [
                'nuevo_nombre_del_sonido' => 'required',
                'sonido' => 'required|mimes:mpga,mp3,mp4,wav,mid,aac'
                    ]);
            
            if($validator->fails()){
                //var_dump($validator->errors());
                return response()->json($validator->errors());
                //return redirect()->back()->withErrors($validator);
            }
            */
            //else {     



            $sonido_a_almacenar = $request->file('sonido');
            $sonido = new audios;

            $sonido->id_usuario = $id;
            $sonido->nombre_original = $sonido_a_almacenar->getClientOriginalName();
            $sonido->nombre_link = $sonido_a_almacenar->store('public');
            $sonido->nombre_mostrar = $request->input('nuevo_nombre_del_sonido');
            $sonido->save();

            
            
            
            //return redirect()->back();
            //return $this->index_auntenticado($id);
    

            //}
        }        
    }
}
