<?php
class Rol extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_rol';
 	public static $primary_key = 'id_rol';

 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 	}
}
