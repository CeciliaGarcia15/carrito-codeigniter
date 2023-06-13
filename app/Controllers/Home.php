<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Product;
use App\Models\Provincia;
use App\Models\Serie;

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
    public function catalogo()
    {
        $producto = new Product();
        $datos['products'] = $producto->where('baja', 'NO')->orderBy('id', 'DESC')->findAll();
        $categoria = new Categoria();
        $serie = new Serie();
        $datos['categorias'] = $categoria->where('baja','NO')->orderBy('categoria','asc')->findAll();
        $datos['series'] = $serie->where('baja','NO')->orderBy('serie','asc')->findAll();
        return view('catalogo',$datos);
    }
    public function filtrarCatalogo()
{
    $producto = new Product();
    // Obtener los valores seleccionados en los filtros
    $categoriaSeleccionada = $this->request->getVar('categoria');
    $serieSeleccionada = $this->request->getVar('serie');
    
    // Obtener los productos filtrados desde tu modelo
    $productosFiltrados = $producto->filtrarProductos($categoriaSeleccionada, $serieSeleccionada);

    // Pasar los productos filtrados a la vista
    $datos['products'] = $productosFiltrados;
    $categoria = new Categoria();
        $serie = new Serie();
        $datos['categorias'] = $categoria->where('baja','NO')->orderBy('categoria','asc')->findAll();
        $datos['series'] = $serie->where('baja','NO')->orderBy('serie','asc')->findAll();
    return view('catalogo', $datos);
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

    public function domypago() {
        $provincia = new Provincia();

        $datos['provincias'] = $provincia->findAll();
        return view('back/ventas/domicilioypago',$datos);
    }

    public function acceso_denegado(){
        return view('sin_permisos');
    }

}
