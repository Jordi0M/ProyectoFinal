@extends('layouts.master')

@section('contenido')
    <div class="row">
        <div style="text-align:left" class="col-sm-2">
            LOGOOOOO
        </div>
        <div style="text-align:center; background-color:yellow; padding-left:1%" class="col-sm-8">
            <button>
                <i class="material-icons" style="float:left">play_arrow</i>
            </button>
            <button>
                <i class="material-icons" style="float:right">stop</i>
            </button>
            &nbsp;
            <button>
                <i class="material-icons" style="float:left">clear</i>
            </button>
            &nbsp;
            <button>
                <i class="material-icons" style="float:right">folder</i>
            </button>
            <button>
                <i class="material-icons" style="float:left">save</i>
            </button>
            &nbsp;
            <button>
                <i class="material-icons" style="float:right">music_note</i>
            </button>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-1">
    		<span >Crash</span> <br>
    		<span >Tom</span> <br>
    		<span>Snare</span> <br>
    		<span>Kick</span>

    		
    	</div>
    	<div></div> 
    </div>
@endsection