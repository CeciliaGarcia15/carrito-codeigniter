<?php 
namespace App\Models;

use CodeIgniter\Model;

class Envio extends Model{
    protected $table      = 'envios';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=[
        'provincias_id','ciudad','direccion','codigo_postal','forma_pago'
    ];
}