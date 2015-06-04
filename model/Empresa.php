<?php
class Empresa extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_empresa';
 	public static $primary_key = 'nit';

 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 	}
}
