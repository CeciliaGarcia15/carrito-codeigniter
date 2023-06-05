<?php 
namespace App\Models;

use CodeIgniter\Model;

class Venta extends Model{
    protected $table      = 'ventas';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=[
        'productos_id','facturas_id','precio_unitario','cantidad'
    ];
}