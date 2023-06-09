<?php 
namespace App\Models;

use CodeIgniter\Model;

class Product extends Model{
    protected $table      = 'productos';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=[
        'producto','precio','cantidad','imagen','baja','categorias_id','series_id'
    ];

    public function search($keyword)
    {
        return $this->select('productos.*, categorias.categoria')
        ->join('categorias', 'categorias.id = productos.categorias_id', 'left')
        ->join('series', 'series.id = productos.series_id', 'left')
        ->like('productos.producto', $keyword)
        ->orLike('categorias.categoria', $keyword)
        ->orLike('series.serie', $keyword)
        ->findAll();
    }

    public function inactivos()
{
    return $this->where('baja', 'SI')->findAll();
}

public function filtrarProductos($categoria, $serie)
{
    $builder = $this->db->table('productos');

    // Aplicar filtros según los valores seleccionados
    if (!empty($categoria)) {
        $builder->where('categorias_id', $categoria);
    }

    if (!empty($serie)) {
        $builder->where('series_id', $serie);
    }

    // Ejecutar la consulta y devolver los resultados
    $query = $builder->get();
    return $query->getResultArray();
}
}