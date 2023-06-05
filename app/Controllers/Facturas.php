<?php 
namespace App\Controllers;

use App\Models\Factura;
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
        $facturaId = $factura['id'];

        // Redirigir al controlador "VentaController" con el ID de la factura
        return redirect()->to('venta/crear/' . $facturaId);
    }

    private function calcularTotal($productos)
    {
        $total = 0;
        foreach ($productos as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        return $total;
    }
}