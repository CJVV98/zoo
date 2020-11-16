<?php

namespace App\Http\Controllers;
use App\Zoologico;
use Illuminate\Http\Request;
use DB;
class ZoologicoController extends Controller
{
    public function index(){
        $zoologicos=DB::table('zoologicos')->select('id_zoologico', 'nombre')->get();
        return $zoologicos;
    }


    public function show($id_zoologico){
        return Zoologico::where('id_zoologico',$id_zoologico)->first();
    }
}
