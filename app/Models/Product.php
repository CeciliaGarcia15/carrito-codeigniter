<?php 
namespace App\Models;

use CodeIgniter\Model;

class Product extends Model{
    protected $table      = 'productos';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=[
        'producto','precio','cantidad','imagen','baja'
    ];
}