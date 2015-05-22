<?php
class Persona extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_persona';
 	public static $primary_key = 'cedula';

 	public function before_create()
 	{
 		$this->sysdate = date('Y-m-d',strtotime('now'));
 	}

 	static $validates_size_of = array(
 		array('cedula', 'within' => array(4,20),
 		     'too_long' => 'La cedula debe ser mas corta',
 			 'too_short' => 'La cedula debe ser mas larga'),

 		array('globalmx_tarjeta_numero', 'within' => array(1,20),
 		     'too_long' => 'El numero de tarjeta debe ser mas corto',
 			 'too_short' => 'El numero de tarjeta debe ser mas largo'),

 		array('globalmx_ciudad_cityid', 'within' => array(1,11),
 		     'too_long' => 'El ID de la ciudad es muy largo',
 			 'too_short' => 'El ID de la ciudad es demasiado corto'),

 		array('nombre', 'within' => array(3,44),
 		     'too_long' => 'El nombre debe ser mas largo',
 			 'too_short' => 'El nombre debe ser mas largo'),

  		array('apellido', 'within' => array(3,44),
 		     'too_long' => 'El apellido debe ser mas corto',
 			 'too_short' => 'El apellido debe ser mas largo'),

 		array('direccion', 'within' => array(8,44),
 		     'too_long' => 'La direccion debe ser mas corta',
 			 'too_short' => 'La direccion debe ser mas larga'),

 		array('barrio', 'within' => array(4,44),
 		     'too_long' => 'El barrio debe ser mas corto',
 			 'too_short' => 'El barrio debe ser mas largo'),

 		array('telefono', 'within' => array(4,20),
 		     'too_long' => 'El telefono debe ser mas corto',
 			 'too_short' => 'El telefono debe ser mas largo'),

 		array('celular', 'within' => array(4,20),
 		     'too_long' => 'El celular debe ser mas corto',
 			 'too_short' => 'El celular debe ser mas largo'),

 		array('email', 'within' => array(1,45),
 		     'too_long' => 'El email debe ser mas corto',
 			 'too_short' => 'El email debe ser mas largo')
    );
}
