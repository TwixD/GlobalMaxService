<?php
class Usuario extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_usuario';
 	public static $primary_key = 'id_usuario';

 	static $validates_size_of = array(
 		array('globalmx_rol_id_rol', 'maximum' => 11, 'too_long' => 'El rol debe ser mas corto'),
 		array('cedula', 'within' => array(2,30), 'too_long' => 'La cedula debe ser mas larga',
 			  'too_short' => 'La cedula debe ser mas larga'),
        array('usuario', 'within' => array(8,20), 'too_short' => 'El usuario debe ser mas largo',
        	  'too_long' => 'El usuario debe ser mas corto'),
        array('contrasena', 'within' => array(8,20), 'too_short' => 'La clave es muy corta',
        	  'too_long' => 'La clave es muy larga')
    );

 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 		$this->contrasena = md5($this->contrasena);
 	}
}