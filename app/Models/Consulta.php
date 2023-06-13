<?php 
namespace App\Models;

use CodeIgniter\Model;

class Consulta extends Model{
    protected $table      = 'consultas';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=[
        'email','nombre_apellido','consulta','estado','fecha'
    ];
}