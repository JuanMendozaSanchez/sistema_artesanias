<?php

namespace SistemaLaOax;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';

    public function subcategorias() {
		return $this->hasMany('Subcategoria');
	}
}
