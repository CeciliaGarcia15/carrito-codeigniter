<?php 
namespace App\Controllers;

use App\Models\Categoria;
use CodeIgniter\Controller;
use App\Models\Product;
use App\Models\Serie;

class Products extends Controller{
    public function index()
    {
        $product = New Product();
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['products'] = $product->orderBy('id','ASC')->findAll();
        $datos['title'] = 'Listado de Productos';
        return view('back/productos/index',$datos);
    }

    public function create()
    {
        $categorias = new Categoria();
        $series = new Serie();
        $datos['categorias'] = $categorias->orderBy('categoria','ASC')->findAll();
        $datos['series'] = $series->orderBy('serie','ASC')->findAll();
        $datos['title'] = 'Nuevo Producto';
        return view('back/productos/create',$datos);
    }

    public function store()
    {
        $producto = new Product();
        $validacion = $this->validate([
            'producto'=>'required|min_length[5]',
            'precio'=>'required|decimal',
            'cantidad'=>'required|integer',
            'categoria' =>'required',
            'serie'=>'required',
            'imagen'=>[
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]'
            ]
            ]);
        if(!$validacion){
            $session= session();
            $session->setFlashdata('mensaje','Revise la información');
            return redirect()->back()->withInput();
        /* return $this->response->redirect(site_url('productos')); */
        }
        if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/img/productos/',$nuevoNombre);
            $datos=[
                'producto'=>$this->request->getVar('producto'),
                'precio'=>$this->request->getVar('precio'),
                'cantidad'=>$this->request->getVar('cantidad'),
                'categorias_id'=>$this->request->getVar('categoria'),
                'series_id'=>$this->request->getVar('serie'),
                'baja'=>'NO',
                'imagen'=>$nuevoNombre
            ];
            $producto->insert($datos);
        }

        return $this->response->redirect(site_url('/productos'));
    }

    public function edit($id= null)
    {
        $producto = new Product();
        $datos['producto']=$producto->where('id',$id)->first();
        $datos['title'] = 'Editar Producto';
        return view('back/productos/edit',$datos);
    }

    public function update(){
        $producto = new Product();
        $datos=[
            'producto'=>$this->request->getVar('producto'),
            'precio'=>$this->request->getVar('precio'),
            'cantidad'=>$this->request->getVar('cantidad'),
            'baja'=>'NO'
        ];
        $id= $this->request->getVar('id');
        $producto->update($id,$datos);

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

                    $datosProducto= $producto->where('id',$id)->first();
                     //obtiene la ruta de la imagen en la db
                    $ruta=('../public/img/productos/'.$datosProducto['imagen']);
                    //borra la imagen
                    unlink($ruta);  



                    $nuevoNombre = $imagen->getRandomName();
                    $imagen->move('../public/img/productos/',$nuevoNombre);
                    $datos=[
                        'imagen'=>$nuevoNombre
                    ];
                    $producto->update($id,$datos);
                }
            }
            return $this->response->redirect(site_url('/productos'));
    }

    public function destroy($id=null)
    {
        $producto = New Product();
        $datosProducto = $producto->where('id',$id)->first();
        //obtiene la ruta de la imagen en la db
       /*  $ruta=('../public/img/productos/'.$datosProducto['imagen']);
        //borra la imagen
        unlink($ruta); */
        //cambia de activo a inactivo el producto
        $datos=[
            'producto'=>$this->request->getVar('producto'),
            'precio'=>$this->request->getVar('precio'),
            'cantidad'=>$this->request->getVar('cantidad'),
            'baja'=>'SI'
        ];
        $producto->update($id,$datos);
        //$producto->where('id',$id)->delete($id);
        return $this->response->redirect(site_url('/productos'));
    }
}