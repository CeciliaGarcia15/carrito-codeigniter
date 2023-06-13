<?php 
namespace App\Controllers;

use App\Models\Envio;
use App\Models\Factura;
use App\Models\Product;
use App\Models\Provincia;
use App\Models\User;
use App\Models\Venta;
use CodeIgniter\Controller;

class Facturas extends Controller{

    //crea la factura y le pasa el id a la ventas
    public function create($envioId)
    {
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        $factura = new Factura();
        $venta = new Venta();

        // Obtener los productos del carrito de la sesión
        $productos = session()->get('cart');
        $usuario = session()->get('usuario');
        $user = new User();

        $u = $user->where('usuario',$usuario)->first();

        // Validar si existen productos en el carrito
        if (!$productos) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Calcular el total de la factura
        $total = $this->calcularTotal($productos);

        // Crear un nuevo registro de factura en la base de datos
        $facturaData = [
            'usuarios_id' => $u['id'], // Obtén el ID del usuario de alguna manera
            'total' => $total,
            'fecha_compra' => date('Y-m-d H:i:s'),
            'envios_id' =>$envioId
        ];
        $factura->insert($facturaData);
        // Obtener el ID de la factura recién insertada
        $facturaId = $factura->insertID();
        // Redirigir al controlador "VentaController" con el ID de la factura
        return redirect()->to('venta/crear/' . $facturaId);
    }

    private function calcularTotal($productos)
    {
        $total = 0;
        $product = new Product();

        foreach ($productos as $producto) {
            $p = $product->where('id',$producto['id'])->first();
            $total += $p['precio'] * $producto['cantidad'];
        }
        return $total;
    }

    //muestra la factura
    public function show($factura_id){
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        $factura = new Factura();
        $user = new User();
        $product = new Product(); 
        $envio = new Envio();
        $provincia = new Provincia();
        $f = $factura->find($factura_id);
        $venta = new Venta();
        $ventas = $venta->where('facturas_id',$factura_id)->findAll();
        $e = $envio->where('id',$f['envios_id'])->first();
        $p = $provincia->where('id',$e['provincias_id'])->first();
        $datos['usuario'] = $user->where('id',$f['usuarios_id'])->first();
        $datos['factura'] = $f;
        $datos['ventas'] = $ventas;
        $datos['envio'] = $e;
        $datos['provincia']= $p;
        $productos = [];
        foreach ($ventas as &$venta) {
            $producto = $product->find($venta['productos_id']);
            $productos[] = $producto;
        }

        $datos['productos'] = $productos;
        $datos['title'] = 'Factura N° ';
        return view('back/facturas/show',$datos);
    }


    //muestra el historial de facturas
    public function historial($user_id){
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        $factura = New Factura();
        
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['facturas'] = $factura->where('usuarios_id',$user_id)->orderBy('id','desc')->findAll();
        $datos['title'] = 'Historial de Compras';
        return view('back/facturas/historial_compras',$datos);
    }
}