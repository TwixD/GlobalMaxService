<?php
class Pais extends ActiveRecord\Model
{
 	public static $table_name = 'globalmx_pais';
 	public static $primary_key = 'CountryId';
    static $has_many = array(
       array('regions')
    );
}