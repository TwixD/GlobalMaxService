<?php
class Pin extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_pin';
 	public static $primary_key = 'id_pin';

 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 		$this->fecha_vencimiento = date('Y-m-d',strtotime('+1 year'));
 	}
}