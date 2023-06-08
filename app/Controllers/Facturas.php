<?php 
namespace App\Controllers;

use App\Models\Factura;
use App\Models\Product;
use App\Models\User;
use App\Models\Venta;
use CodeIgniter\Controller;

class Facturas extends Controller{
    public function create()
    {
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
            'fecha_compra' => date('Y-m-d H:i:s')
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

    public function show($factura_id){
        $factura = new Factura();
        $user = new User();
        $product = new Product(); 
        $f = $factura->find($factura_id);
        $venta = new Venta();
        $ventas = $venta->where('facturas_id',$factura_id)->findAll();
        $datos['usuario'] = $user->where('id',$f['usuarios_id'])->first();
        $datos['factura'] = $f;
        $datos['ventas'] = $ventas;
        $productos = [];
        foreach ($ventas as &$venta) {
            $producto = $product->find($venta['productos_id']);
            $productos[] = $producto;
        }

        $datos['productos'] = $productos;
        $datos['title'] = 'Factura N° ';
        return view('back/facturas/show',$datos);
    }


    public function historial($user_id){
        $factura = New Factura();
        
        //el users de dentro de las llaves es la variable que se importa a la vista
        $datos['facturas'] = $factura->where('usuarios_id',$user_id)->orderBy('id','desc')->findAll();
        $datos['title'] = 'Historial de Compras';
        return view('back/facturas/historial_compras',$datos);
    }
}