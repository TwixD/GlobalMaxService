<?php
class Transaccion extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_transaccion';
 	public static $primary_key = 'idglobalmx_transaccion';

 	public function before_create()
 	{
 		$this->fecha_registro = date("Y-m-d H:i:s");
 	}
}