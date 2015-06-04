<?php
class Estado extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_estado';
 	public static $primary_key = 'id_estado';
 	
 	public function before_create()
 	{
 		$this->fecha_registro = date('Y-m-d',strtotime('now'));
 	}

}