<?php 
namespace App\Controllers;

use App\Models\Product;
use App\Models\Venta;
use CodeIgniter\Controller;

class Ventas extends Controller{
    public function create($facturas_id)
    {
        $venta = new Venta();
        $product = new Product();
        $productos = session()->get('cart');
        if (!$productos) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }
         // Crear una nueva venta por cada producto del carrito
         foreach ($productos as $producto) {
            $p = $product->where('id',$producto['id'])->first();
            $ventaData = [
                'productos_id' => $producto['id'],
                'facturas_id' => $facturas_id,
                'precio_unitario' => $p['precio'],
                'cantidad' => $producto['cantidad']
            ];
            $venta->insert($ventaData);

             // Actualizar el stock del producto y si el stock es 0 que lo de de baja
        $newStock = $p['cantidad'] - $producto['cantidad'];
        if($newStock == 0){
            $product->update($producto['id'], ['cantidad' => $newStock, 'baja' => "SI"]);
        }else{
            $product->update($producto['id'], ['cantidad' => $newStock]);
        }
        
        }

        // Limpiar el carrito de compras después de completar las ventas
        session()->remove('cart');

        return redirect()->to('factura/ver/'.$facturas_id);
    }

  

}