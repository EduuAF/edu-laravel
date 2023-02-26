<?php

namespace App\Http\Controllers;
use App\Models\Sala;

class AppController extends Controller
{
    public function index()
    {
        //Obtengo las salas a mostrar en la home
        $rowset = Sala::where('activo', 1)->where('home', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);
    }

    public function salas()
    {
        //Obtengo las salas a mostrar en el listado de salas
        $rowset = Sala::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.salas',[
            'rowset' => $rowset,
        ]);
    }

    public function sala($slug)
    {
        //Obtengo la sala o muestro error
        $row = Sala::where('activo', 1)->where('slug', $slug)->firstOrFail();

        return view('app.sala',[
            'row' => $row,
        ]);
    }

    public function acercade()
    {
        return view('app.acerca-de');
    }

    //Métodos para la API (podrían ir en otro controlador)

    public function mostrar(){

        //Obtengo las salas a mostrar en el listado de salas
        $rowset = Sala::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        //Opción rápida (datos completos)
        //$salas = $rowset;

        //Opción personalizada
        foreach ($rowset as $row){
            $salas[] = [
                'titulo' => $row->titulo,
                'entradilla' => $row->entradilla,
                'autor' => $row->autor,
                'fecha' => date("d/m/Y", strtotime($row->fecha)),
                'enlace' => url("sala/".$row->slug),
                'imagen' => asset("img/".$row->imagen)
            ];
        }

        //Devuelvo JSON
        return response()->json(
            $salas, //Array de objetos
            200, //Tipo de respuesta
            [], //Headers
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE //Opciones de escape
        );

    }

    public function leer(){

        //Url de destino
        $url = "http://13.37.88.251/cms-laravel/public/index.php/mostrar";

        //Parseo datos a un array
        $rowset = json_decode(file_get_contents($url), true);

        //LLamo a la vista
        return view('api.leer',[
            'rowset' => $rowset,
        ]);

    }
}
