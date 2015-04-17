 <?php
 require 'config/con/config.php';
 $module = array_values(getYamlRute())[0]['module'];
 $metodoAction = array_values(getYamlRute())[0]['action'];
 $classRoute = ''.array_values(getYamlRute())[0]['app'].'/'.$module.'.php';
 require_once $classRoute;
 $clasePruebaAction = new $module();
 $clasePruebaAction->$metodoAction();
 ?>
