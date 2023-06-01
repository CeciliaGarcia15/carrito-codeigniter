<?php

namespace App\Controllers;

use App\Models\Product;
use CodeIgniter\Controller;

class Carts extends Controller
{

    public function index()
    {
        $cart = [];

        if (session()->has('cart')) {
            $cart = session()->get('cart');
        }
        
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
        
        return view('carrito', ['products' => $products]);
    }

    public function agregarCarrito($productID)
    {
        if (!session()->has('cart')) {
            // Si el carrito no existe, inicializarlo como un array vacío
            $cart = [];
            session()->set('cart', $cart);
        } else {
            // Si el carrito existe, obtenerlo de la sesión
            $cart = session()->get('cart');
        }
     

        // Verifica si el producto ya existe en el carrito
        $productIndex = $this->findProductIndex($productID, $cart);
        var_dump($productIndex);
        die();
        if ($productIndex !== false) {
            // Verificar si la clave 'cantidad' existe antes de acceder a ella
            if (array_key_exists('cantidad', $cart[$productIndex])) {
                // La clave 'cantidad' existe, incrementa su valor
                $cart[$productIndex]['cantidad']++;
            } else {
                // La clave 'cantidad' no existe, agregarla con un valor de 1
                $cart[$productIndex]['cantidad'] = 1;
            }
        } else {
            // Si el producto no existe, agrega un nuevo ítem al carrito
            $cart[] = [
                'id' => $productID,
                'cantidad' => 1
            ];
        }

        session()->set('cart', $cart);

        return redirect()->to('/carrito');
    }

    // Función auxiliar para encontrar el índice de un producto en el carrito
    private function findProductIndex($productID, $cart)
    {
        foreach ($cart as $index => $item) {
            if ($item['id'] === $productID) {
                return $index;
            }
        }

        return false;
    }

    public function eliminarCarrito($productId)
    {
        // Obtener el carrito actual de la sesión
        $cartItems = session()->get('cart_items') ?? [];

        // Buscar y eliminar el producto del carrito
        $index = array_search($productId, $cartItems);
        if ($index !== false) {
            unset($cartItems[$index]);
        }

        // Actualizar el carrito en la sesión
        session()->set('cart_items', $cartItems);

        return redirect()->to('/cart');
    }

    public function limpiarCarrito()
    {
        // Eliminar el carrito de la sesión
        session()->remove('cart');

        return redirect()->to('/carrito');
    }
}
