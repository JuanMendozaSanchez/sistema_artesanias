<?php

namespace SistemaLaOax;

use Illuminate\Database\Eloquent\Model;
use SistemaLaOax\Categoria;

class Subcategoria extends Model
{
    protected $table = 'subcat';

    public function categorias(){
    	return $this->belongsTo('Categoria', 'sub_id');
    }
    
}
