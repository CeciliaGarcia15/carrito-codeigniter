<?php 
namespace App\Controllers;

use App\Models\Venta;
use CodeIgniter\Controller;

class Ventas extends Controller{
    public function create($facturas_id)
    {
        $venta = new Venta();
        $productos = session()->get('cart');
        if (!$productos) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }
         // Crear una nueva venta por cada producto del carrito
         foreach ($productos as $producto) {
            $ventaData = [
                'productos_id' => $producto['id'],
                'facturas_id' => $facturas_id,
                'precio_unitario' => $producto['precio'],
                'cantidad' => $producto['cantidad']
            ];
            $venta->insert($ventaData);
        }

        // Limpiar el carrito de compras después de completar las ventas
        session()->remove('cart');

        return redirect()->to('ruta-de-confirmacion')->with('success', 'Las ventas se han registrado exitosamente.');
    }
}