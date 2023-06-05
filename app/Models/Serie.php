<?php 
namespace App\Models;

use CodeIgniter\Model;

class Serie extends Model{
    protected $table      = 'series';
    // Uncomment below if you want add primary key
     protected $primaryKey = 'id';
     protected $allowedFields=[
        'serie','baja','imagen'
    ];
}