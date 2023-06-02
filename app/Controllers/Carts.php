<?php

namespace App\Controllers;

use App\Models\Product;
use CodeIgniter\Controller;

class Carts extends Controller
{

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

    return view('carrito', ['products' => $products, 'cart'=>$cart]);
}

public function agregarCarrito($productId)
{
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

    return redirect()->to(base_url('/carrito'));
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
    // Eliminar el carrito de la sesión
    session()->remove('cart');

    return redirect()->to('/carrito');
}

}