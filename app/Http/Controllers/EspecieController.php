<?php

namespace App\Http\Controllers;
use App\Especie;
use DB;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function index(){
        $especies=DB::table('especies')->select('id_especie', 'nombre_vulgar')->get();
        return $especies;
    }


    public function show($id_especie){
        return Especie::where('id_especie',$id_especie)->first();
    }
}
