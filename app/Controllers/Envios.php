<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Envio;
use App\Models\Provincia;

class Envios extends Controller{


    //guarda la info del envio y envia el envioID a la factura
    public function store()
    {
        if (!(session()->logged_in && session()->has('usuario'))) {
            var_dump(session()->logged_in);
            die();
            return redirect()->to('/acceso_denegado');
        }
        $envio = new Envio();
        $validacion = $this->validate([
            'provincias' => [
                'label' => 'Provincia',
                'rules' => 'required|greater_than[0]',
                'errors' => [
                    'greater_than' => 'Por favor, elige una provincia válida.'
                ]
            ],
            'ciudad' => 'required|min_length[3]',
            'direccion' => 'required|min_length[3]',
            'codigo' => 'required',
            'formas_pago' => 'required'
            ]);

            if (!$validacion) {
                $datos['errors'] = $this->validator->getErrors();
                $provincia = new Provincia();

                $datos['provincias'] = $provincia->findAll();
                return view('back/ventas/domicilioypago',$datos);
                
            }

        // Crear un nuevo registro de factura en la base de datos
        $envioData = [
            'provincias_id'=> $this->request->getVar('provincias'), 
            'ciudad' => $this->request->getVar('ciudad') ,
            'direccion' => $this->request->getVar('direccion') ,
            'codigo_postal' => $this->request->getVar('codigo') ,
            'forma_pago' => $this->request->getVar('formas_pago'),
        ];
        $envio->insert($envioData);
        // Obtener el ID de la envio recién insertada
        $envioId = $envio->insertID();
        // Redirigir al controlador "VentaController" con el ID de la envio
        return redirect()->to('factura/generar/' . $envioId);
    }
}