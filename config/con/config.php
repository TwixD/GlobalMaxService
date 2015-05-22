<?php
 include('util/ConstantString.php');
 include('util/FormatJSON.php');
 require_once 'lib/vendor/php-activerecord/ActiveRecord.php';
 include('lib/vendor/spyc/spyc.php');
 require_once 'lib/base/LogSystem.php';
 require_once 'lib/base/MailSystem.php';
 require_once 'lib/base/Security.php';
 require_once 'conexion.php';
ActiveRecord\Config::initialize(function($cfg)
 {
     $cfg->set_model_directory('model');
     $cfg->set_connections(array(
         'development' => 'mysql://'.CON_USER.':'.CON_PASS.'@'.CON_HOST.'/'.CON_DB));
 });

 function getParam($paramName){
    $callers=debug_backtrace();
    $callers = $callers[1]['function'];
    $llave = null;
    foreach (array_values(getYamlRute()) as $key => $value) {
        if(!is_null($llave )){
            break;
        }
        foreach ($value as $key2 => $value2) {
            if($value2 == $callers){
                $llave = $key;
                break;
            }
        }
    }
 	if(strcasecmp(array_values(getYamlRute())[$llave]['method'], 'GET') == 0){
 		return $_GET[$paramName];
 	}else{
		return $_POST[$paramName];
 	}
 }

 function getYamlRute() {
        if (!isCompiled(ORIGINAL_FILE, COMPILED_FILE)) {
            $data = Spyc::YAMLLoad(ORIGINAL_FILE);
            $phpCode = '$data = ' . var_export($data, TRUE) . ';';
            file_put_contents(COMPILED_FILE, "<?php\n\n" . $phpCode . "\n\n?>");
        } else {
            require(COMPILED_FILE);
        }
        return $data;
 }

  function isCompiled($originalFile, $compiledFile) {
        if (file_exists($compiledFile)) {
            if (filemtime($originalFile) < filemtime($compiledFile)) {
                return TRUE;
            }
        }
        return FALSE;
   }
 ?>
