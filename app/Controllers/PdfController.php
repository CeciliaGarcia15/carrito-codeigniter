<?php

namespace App\Controllers;

use App\Models\Envio;
use Dompdf\Dompdf;
use App\Models\Factura;
use App\Models\Venta;
use App\Models\Product;
use App\Models\Provincia;
use App\Models\User;

class PdfController extends BaseController
{
    public function generateFacturaPdf($factura_id)
    {
        // Obtener los datos necesarios para la factura
        $facturaModel = new Factura();
        $ventaModel = new Venta();
        $productoModel = new Product();
        $userModel = new User();
        $envio = new Envio();
        $provincia = new Provincia();

        $factura = $facturaModel->find($factura_id);
        $usuario = $userModel->find($factura['usuarios_id']);
        $ventas = $ventaModel->where('facturas_id', $factura_id)->findAll();
        $e = $envio->where('id',$factura['envios_id'])->first();
        $p = $provincia->where('id',$e['provincias_id'])->first();

        $data['factura'] = $factura;
        $data['usuario'] = $usuario;
        $data['envio'] = $e;
        $data['provincia']= $p;

        // Obtener los productos asociados a las ventas
        $productos = [];
        foreach ($ventas as $venta) {
            $producto = $productoModel->find($venta['productos_id']);
            $venta['producto'] = $producto;
            $productos[] = $venta['producto'];
        }

        $data['factura'] = $factura;
        $data['ventas'] = $ventas;
        $data['productos'] = $productos;
        
        $data['title'] = 'Factura N° ';
        $html = view('back/facturas/show_pdf', $data);

        // Configurar dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

          // Generar el archivo PDF
        $dompdf->render();
        $dompdf->stream('factura.pdf');
    }
}
