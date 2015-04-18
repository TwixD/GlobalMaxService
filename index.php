 <?php
 require 'config/con/config.php';
 $llave = null;
 foreach (array_keys(getYamlRute()) as $key => $value) {
 	if($value == $_GET['route']){
 		$llave = $key;
 	}
 }
 $module = array_values(getYamlRute())[$llave]['module'];
 $metodoAction = array_values(getYamlRute())[$llave]['action'];
 $classRoute = ''.array_values(getYamlRute())[$llave]['app'].'/'.$module.'.php';
 require_once $classRoute;
 $clasePruebaAction = new $module();
 $clasePruebaAction->$metodoAction();
 ?>
