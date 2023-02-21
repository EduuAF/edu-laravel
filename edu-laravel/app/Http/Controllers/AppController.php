<?php

namespace App\Http\Controllers;
use App\Models\Noticia;

class AppController extends Controller
{
    public function index()
    {
        //Obtengo las noticias a mostrar en la home
        $rowset = Noticia::where('activo', 1)->where('home', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);
    }

    public function noticias()
    {
        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Noticia::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.noticias',[
            'rowset' => $rowset,
        ]);
    }

    public function noticia($slug)
    {
        //Obtengo la noticia o muestro error
        $row = Noticia::where('activo', 1)->where('slug', $slug)->firstOrFail();

        return view('app.noticia',[
            'row' => $row,
        ]);
    }

    public function acercade()
    {
        return view('app.acerca-de');
    }
}
