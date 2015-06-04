<?php
class Impresion extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_impresion';
 	public static $primary_key = 'idglobalmx_impresion';
 	
 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 	}
}