<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Serie;
class Series extends Controller{
    public function index()
    {
        $serie = New serie();
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['series'] = $serie->orderBy('id','ASC')->findAll();
        $datos['title'] = 'Listado de series';
        return view('back/series/index',$datos);
    }

    public function create()
    {
        
        $datos['title'] = 'Nueva serie';
        return view('back/series/create',$datos);
    }

    public function store()
    {
        $serie = new serie();
        $validacion = $this->validate([
            'serie'=>'required|min_length[5]',
            'imagen'=>[
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]'
            ]
            ]);
            
           
         if(!$validacion){
            $session= session();
            $session->setFlashdata('mensaje','La información ingresada no es valida');
            return redirect()->back()->withInput();
         /* return $this->response->redirect(site_url('series'));  */
        } 
        
        if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/img/series/',$nuevoNombre);
            $datos=[
                'serie'=>$this->request->getVar('serie'),
                'baja'=>'NO',
                'imagen'=>$nuevoNombre
            ];
            
            $serie->insert($datos);
        }

        return $this->response->redirect(site_url('/series'));
    }

    public function edit($id= null)
    {
        $serie = new serie();
        $datos['serie']=$serie->where('id',$id)->first();
        $datos['title'] = 'Editar serie';
        return view('back/series/edit',$datos);
    }

    public function update(){
        $serie = new serie();
        $datos=[
            'serie'=>$this->request->getVar('serie'),
            'baja'=>'NO'
        ];
        $id= $this->request->getVar('id');
        $serie->update($id,$datos);

        $validacion = $this->validate([
            'imagen'=>[
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]'
            ]
            ]);
            //si existe una validacion entonces pregunta por la imagen
            if($validacion){
                if($imagen=$this->request->getFile('imagen')){

                    $datosserie= $serie->where('id',$id)->first();
                     //obtiene la ruta de la imagen en la db
                    $ruta=('../public/img/series/'.$datosserie['imagen']);
                    //borra la imagen
                    unlink($ruta);  



                    $nuevoNombre = $imagen->getRandomName();
                    $imagen->move('../public/img/series/',$nuevoNombre);
                    $datos=[
                        'imagen'=>$nuevoNombre
                    ];
                    $serie->update($id,$datos);
                }
            }
            return $this->response->redirect(site_url('/series'));
    }

    public function destroy($id=null)
    {
        $serie = New serie();
        $datosserie = $serie->where('id',$id)->first();
        //obtiene la ruta de la imagen en la db
       /*  $ruta=('../public/img/series/'.$datosserie['imagen']);
        //borra la imagen
        unlink($ruta); */
        //cambia de activo a inactivo el serie
        $datos=[
            'baja'=>'SI'
        ];
        $serie->update($id,$datos);
        //$serie->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/series'));
    }

    public function search()
    {
        if (session()->logged_in && session()->has('admin')) {
            $search = $this->request->getVar('search');

            $serie = new serie();
            $series = $serie->search($search);
    
            $datos['title'] = "Buscando: ".$search;
            $datos['series'] = $series;
    
            return view('back/series/index', $datos);
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }
     public function inactivos()
    {
        if (session()->logged_in && session()->has('admin')) {
            $serie = new serie();
            $series = $serie->inactivos();
    
            $datos['title'] = 'Listado de serieos';
            $datos['series'] = $series;
            $datos['inactivo'] = 1;
    
            return view('back/series/index', $datos);
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }
}