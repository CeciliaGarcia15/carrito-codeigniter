<?php 
namespace App\Controllers;

use App\Models\Categoria;
use CodeIgniter\Controller;
use App\Models\Product;
use App\Models\Serie;

class Products extends Controller{
    public function index()
    {
        // Verificar si la sesión está activa y si existe una sesion llamada admin
        if (session()->logged_in && session()->has('admin')) {
            $product = New Product();
            //el users de dentro de las llaves es la variable que se importa a la vista
            $datos['products'] = $product->orderBy('id','ASC')->findAll();
            $datos['title'] = 'Listado de Productos';
            return view('back/productos/index',$datos);
        } else {
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
    }

    public function create()
    {
        if (session()->logged_in && session()->has('admin')) {
            $categorias = new Categoria();
            $series = new Serie();
            $datos['categorias'] = $categorias->orderBy('categoria','ASC')->findAll();
            $datos['series'] = $series->orderBy('serie','ASC')->findAll();
            $datos['title'] = 'Nuevo Producto';
            return view('back/productos/create',$datos);
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }

    public function store()
    {
        if (session()->logged_in && session()->has('admin')) {
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
                $session->setFlashdata('mensaje','La información ingresada no es valida');
                return redirect()->back()->withInput();
             /* return $this->response->redirect(site_url('productos'));  */
            } 
            
            if($imagen=$this->request->getFile('imagen')){
                $nuevoNombre = $imagen->getRandomName();
                $imagen->move('../public/img/productos/',$nuevoNombre);
                $datos=[
                    'producto'=>$this->request->getVar('producto'),
                    'precio'=>$this->request->getVar('precio'),
                    'cantidad'=>$this->request->getVar('cantidad'),
                    'categorias_id'=>(int)$this->request->getVar('categoria'),
                    'series_id'=>$this->request->getVar('serie'),
                    'baja'=>'NO',
                    'imagen'=>$nuevoNombre
                ];
                
                $producto->insert($datos);
            }
    
            return $this->response->redirect(site_url('/productos'));
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }

    public function edit($id= null)
    {
        if (session()->logged_in && session()->has('admin')) {
            $producto = new Product();
            $datos['producto']=$producto->where('id',$id)->first();
            $categorias = new Categoria();
            $series = new Serie();
            $datos['categorias'] = $categorias->orderBy('categoria','ASC')->findAll();
            $datos['series'] = $series->orderBy('serie','ASC')->findAll();
            $datos['title'] = 'Editar Producto';
            return view('back/productos/edit',$datos);
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
       
    }

    public function update(){
        if (session()->logged_in && session()->has('admin')) {
            $producto = new Product();
            $datos=[
                'producto'=>$this->request->getVar('producto'),
                'precio'=>$this->request->getVar('precio'),
                'cantidad'=>$this->request->getVar('cantidad'),
                'categorias_id'=>$this->request->getVar('categoria'),
                'series_id'=>$this->request->getVar('serie'),
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
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }

    public function destroy($id=null)
    {
        if (session()->logged_in && session()->has('admin')) {
            $producto = New Product();
            $datosProducto = $producto->where('id',$id)->first();
            //obtiene la ruta de la imagen en la db
           /*  $ruta=('../public/img/productos/'.$datosProducto['imagen']);
            //borra la imagen
            unlink($ruta); */
            //cambia de activo a inactivo el producto
            $datos=[
                'baja'=>'SI'
            ];
            $producto->update($id,$datos);
            //$producto->where('id',$id)->delete($id);
            return $this->response->redirect(site_url('/productos'));
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }

        public function search()
    {
        if (session()->logged_in && session()->has('admin')) {
            $search = $this->request->getVar('search');

            $product = new Product();
            $products = $product->search($search);
    
            $datos['title'] = "Buscando: ".$search;
            $datos['products'] = $products;
    
            return view('back/productos/index', $datos);
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }
   
    public function inactivos()
    {
        if (session()->logged_in && session()->has('admin')) {
            $product = new Product();
            $products = $product->inactivos();
    
            $datos['title'] = 'Listado de Productos';
            $datos['products'] = $products;
            $datos['inactivo'] = 1;
    
            return view('back/productos/index', $datos);
        }else{
            // Redireccionar o mostrar un mensaje de error
            return redirect()->to('/acceso_denegado');
        }
        
    }

    public function searchCatalogo()
    {
        $search = $this->request->getVar('search');

        $product = new Product();
        $products = $product->where('baja',"NO")->search($search);

        $datos['title'] = "Buscando: ".$search;
        $datos['products'] = $products;
        $categoria = new Categoria();
        $serie = new Serie();
        $datos['categorias'] = $categoria->where('baja','NO')->orderBy('categoria','asc')->findAll();
        $datos['series'] = $serie->where('baja','NO')->orderBy('serie','asc')->findAll();
        return view('/catalogo', $datos);
    }
}