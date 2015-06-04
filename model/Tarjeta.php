<?php
class Tarjeta extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_tarjeta';
 	public static $primary_key = 'numero';

 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 	}

 	static $validates_size_of = array(
 		array('numero', 'within' => array(16,20),
 		     'too_long' => 'El numero de tarjeta debe ser mas corto',
 			 'too_short' => 'El numero de tarjeta debe ser mas largo')
    );

}