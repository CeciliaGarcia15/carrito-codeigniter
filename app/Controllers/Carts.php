<?php

namespace App\Controllers;

use App\Models\Product;
use CodeIgniter\Controller;

class Carts extends Controller
{
    public function __construct()
    {
        helper('url');
    }
    public function index()
    {
        
        // Obtener el contenido actual del carrito (si existe)
        $cart = session()->get('cart') ?? [];

        // Obtén información adicional de los productos desde la base de datos
        $productModel = new Product();
        $products = [];

        foreach ($cart as $item) {
            $product = $productModel->find($item['id']);

            if ($product) {
                $products[] = [
                    'id' => $product['id'],
                    'producto' => $product['producto'],
                    'precio' => $product['precio'],
                    'cantidad' => $item['cantidad']
                ];
            }
        }

        return view('carrito', ['products' => $products, 'cart' => $cart]);
    }

    public function agregarCarrito($productId)
    {
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        // Obtener el producto a agregar desde la base de datos o cualquier otra fuente de datos
        $productModel = new Product();
        $product = $productModel->find($productId);

        // Verificar si el producto existe
        if ($product) {
            // Obtener el carrito actual de la sesión
            $cart = session()->get('cart') ?? [];

            // Verificar si el producto ya está en el carrito
            $productIndex = $this->findProductIndex($productId, $cart);

            if ($productIndex !== -1) {
                // Si el producto ya está en el carrito, incrementar la cantidad
                $cart[$productIndex]['cantidad']++;
            } else {
                // Si el producto no está en el carrito, agregarlo como un nuevo elemento
                $cart[] = [
                    'id' => $productId,
                    'cantidad' => 1
                ];
            }

            // Actualizar el carrito en la sesión
            session()->set('cart', $cart);
        }

        $previousURL = previous_url();
        return redirect()->to($previousURL);
    }


    //maneja los botones de incrementar y decrementar del carrito
    public function actualizar($productId)
    {
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        // Obtener la nueva cantidad enviada desde el formulario
        $newQuantity = $this->request->getVar('quantity');
    
        // Verificar si la nueva cantidad es válida
        if (!empty($newQuantity) && is_numeric($newQuantity)) {
            $newQuantity = (int) $newQuantity;
    
            // Obtener el producto desde la base de datos
            $productModel = new Product();
            $product = $productModel->find($productId);
    
            // Verificar si el producto existe
            if ($product) {
                // Verificar si la nueva cantidad supera el stock disponible
                if ($newQuantity <= $product['cantidad']) {
                    // Obtener el carrito actual de la sesión
                    $cart = session()->get('cart') ?? [];
    
                    // Verificar si el producto ya está en el carrito
                    $productIndex = $this->findProductIndex($productId, $cart);
    
                    if ($productIndex !== -1) {
                        // Si el producto está en el carrito, actualizar la cantidad
                        if ($newQuantity <= 0) {
                            // Si la nueva cantidad es menor o igual a cero, eliminar el producto del carrito
                            unset($cart[$productIndex]);
                        } else {
                            // Actualizar la cantidad del producto en el carrito
                            $cart[$productIndex]['cantidad'] = $newQuantity;
                        }
    
                        // Actualizar el carrito en la sesión
                        session()->set('cart', $cart);
                    }
                } else {
                    // La nueva cantidad supera el stock disponible, mostrar un mensaje de error o redireccionar a una página de aviso
                    return redirect()->back()->with('error', 'La cantidad supera el stock disponible.');
                }
            }
        }
    
        return redirect()->back();
    }


    // Función auxiliar para encontrar el índice de un producto en el carrito
    private function findProductIndex($productId, $cart)
    {
        foreach ($cart as $index => $item) {
            if ($item['id'] === $productId) {
                return $index;
            }
        }

        return -1;
    }

    public function eliminarCarrito($productId)
    {
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        // Obtener el carrito actual de la sesión
        $cart = session()->get('cart') ?? [];

        // Buscar y eliminar el producto del carrito
        $productIndex = $this->findProductIndex($productId, $cart);

        if ($productIndex !== -1) {
            unset($cart[$productIndex]);
        }

        // Actualizar el carrito en la sesión
        session()->set('cart', $cart);

        return redirect()->to('/carrito');
    }

    public function limpiarCarrito()
    {
        if (!(session()->logged_in && session()->has('usuario'))) {
            return redirect()->to('/acceso_denegado');
        }
        // Eliminar el carrito de la sesión
        session()->remove('cart');

        return redirect()->to('/carrito');
    }
}
