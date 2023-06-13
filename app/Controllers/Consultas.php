<?php 
namespace App\Controllers;

use App\Models\Consulta;
use CodeIgniter\Controller;

class Consultas extends Controller{

    public function index(){
        $consulta = new Consulta();
        $datos['consultas'] = $consulta->orderBy('id','desc')->findAll();
        $datos['title'] = 'Consultas';
        return view('back/consultas/index',$datos);
    }

    public function store(){
        $consulta = new Consulta();
        $validacion = $this->validate([
            'email'=>'required|min_length[10]',
            'nombre'=>'required|min_length[5]',
            'consulta'=>'required|min_length[2]',
            ]);


         if(!$validacion){
            $session= session();
            $session->setFlashdata('error','La información ingresada no es valida');
            return redirect()->back()->withInput();
         /* return $this->response->redirect(site_url('consultas'));  */
        } 
        
            $datos=[
                'email'=>$this->request->getVar('email'),
                'nombre_apellido'=>$this->request->getVar('nombre'),
                'consulta'=>$this->request->getVar('consulta'),
                'estado'=> 'no leido',
                'fecha'=>date('Y-m-d H:i:s')
            ];
            
            $consulta->insert($datos);
        $data['success'] = 'Recibimos tu consulta, a la brevedad recibira un email con la respuesta.';
        return view('/contacto',$data);
    }
    
}