<?php

namespace App\Controllers;

use App\Models\Product;

class Home extends BaseController
{
    public function index()
    {
        $producto = new Product();
        $datos['products'] = $producto->where('baja', 'NO')->orderBy('id', 'DESC')->findAll(6);
        $mensaje = session('mensaje');
        $datos['mensaje'] = $mensaje;
        return view('principal',$datos);
    }

    public function comercializacionIndex()
    {
        return view('comercializacion');
    }
    public function contactoIndex()
    { 
        return view('contacto');
    }

    public function contactoStore()
    { 
        $nombre = $this->request->getVar('nombre');
        print_r($nombre);
        $datos['nombre'] = $nombre;
        $datos['success'] =  'Su mensaje fue enviado exitosamente.';
         return view('contacto',$datos); 
    }
    public function quienes_somosIndex()
    {
        
        return view('quienes_somos');
    }

    public function terminosIndex()
    {
        
        return view('terminos');
    }

}
