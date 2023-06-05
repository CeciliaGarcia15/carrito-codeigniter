<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Categoria;
class Categorias extends Controller{
    public function index()
    {
        $categoria = New categoria();
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['categorias'] = $categoria->orderBy('id','ASC')->findAll();
        $datos['title'] = 'Listado de categorias';
        return view('back/categorias/index',$datos);
    }

    public function create()
    {
        $datos['title'] = 'Nueva categoria';
        return view('back/categorias/create',$datos);
    }

    public function store()
    {
        $categoria = new categoria();
        $validacion = $this->validate([
            'categoria'=>'required|min_length[5]',
            ]);
            
           
         if(!$validacion){
            $session= session();
            $session->setFlashdata('mensaje','La información ingresada no es valida');
            return redirect()->back()->withInput();
         /* return $this->response->redirect(site_url('categorias'));  */
        } 
        
        
            $datos=[
                'categoria'=>$this->request->getVar('categoria'),
                'baja'=>'NO',
            ];
            
            $categoria->insert($datos);

        return $this->response->redirect(site_url('/categorias'));
    }

    public function edit($id= null)
    {
        $categoria = new categoria();
        $datos['categoria']=$categoria->where('id',$id)->first();
        $datos['title'] = 'Editar categoria';
        return view('back/categorias/edit',$datos);
    }

    public function update(){
        $categoria = new categoria();
            $datos=[
                'categoria'=>$this->request->getVar('categoria'),
                'baja'=>'NO',
            ];
        $id= $this->request->getVar('id');
        $categoria->update($id,$datos);

        return $this->response->redirect(site_url('/categorias'));
    }

    public function destroy($id=null)
    {
        $categoria = New categoria();
        //obtiene la ruta de la imagen en la db
       /*  $ruta=('../public/img/categorias/'.$datoscategoria['imagen']);
        //borra la imagen
        unlink($ruta); */
        //cambia de baja a inbaja el categoria
        $datos=[
            'baja'=>'SI',
        ];
        $categoria->update($id,$datos);
        //$categoria->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/categorias'));
    }
}