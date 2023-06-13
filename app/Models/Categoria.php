<?php 
namespace App\Models;

use CodeIgniter\Model;

class Categoria extends Model{
    protected $table      = 'categorias';
    // Uncomment below if you want add primary key
     protected $primaryKey = 'id';
     protected $allowedFields=[
        'categoria','baja'
    ];


    public function search($keyword)
    {
        return $this->like('categoria', $keyword)->findAll();
    }

    public function inactivos()
{
    return $this->where('baja', 'SI')->findAll();
}

}