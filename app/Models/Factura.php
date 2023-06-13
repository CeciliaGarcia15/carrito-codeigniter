<?php 
namespace App\Models;

use CodeIgniter\Model;

class Factura extends Model{
    protected $table      = 'facturas';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=[
        'usuarios_id','total','fecha_compra','envios_id'
    ];

    
}