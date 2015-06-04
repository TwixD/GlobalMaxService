<?php
class ControllerEmpresa{

	public function createEmpresa(){
		$empresa = new Empresa();
		$empresa->nit = getParam('nit');
		$empresa->nombre = getParam('nombre');
		$empresa->direccion = getParam('direccion');	
		$empresa->telefono = getParam('telefono');
		$empresa->ip = getParam('ip');
		$empresa->trama = getParam('trama');
		try{
			$ret = $empresa->save();
			if($ret == false){
		   		 processFailed(ERR,EMPRESA_ERROR_1);
		  		 exit(0);
			}else{
                 processSuccess(EMPRESA_SUCCES_1);
		  		 exit(0);
			}
		}catch(ActiveRecord\DatabaseException $e){
		    processFailed(ERR,EMPRESA_ERROR_1);
		    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		    exit(0);
		}
	}

	public function updateEmpresa(){
		try{
			$empresa = Empresa::find(getParam('nit'));
		        if(!is_null(getParam('nombre')) || strlen(getParam('nombre')) > 0){
					$empresa->nombre = getParam('nombre');
		        }
		        if(!is_null(getParam('direccion')) || strlen(getParam('direccion')) > 0){
					$empresa->direccion = getParam('direccion');
		        }
		        if(!is_null(getParam('telefono')) || strlen(getParam('telefono')) > 0){
					$empresa->telefono = getParam('telefono');
		        }
		        if(!is_null(getParam('ip')) || strlen(getParam('ip')) > 0){
					$empresa->ip = getParam('ip');
		        }
		        if(!is_null(getParam('trama')) || strlen(getParam('trama')) > 0){
					$empresa->trama = getParam('trama');
		        }
			try{
				$ret = $empresa->save();
			}catch(ActiveRecord\DatabaseException $e){
		 	    processFailed(ERR,EMPRESA_ERROR_2);
		 		printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		        exit(0);
			}

			if($ret == false){
		   		 processFailed(ERR,EMPRESA_ERROR_2);
		  		 exit(0);
			}else{
                 processSuccess(EMPRESA_SUCCES_2);
		  		 exit(0);
			}
		}catch(ActiveRecord\RecordNotFound $e){
			processFailed(ERR,EMPRESA_ERROR_3);
            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            exit(0);
		}
	}

	public function listEmpresa(){
		 try{
			$data = Empresa::find('all');
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			$concac = substr($concac, 0, strlen($concac) - 1);
			processSuccess($concac);
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,EMPRESA_ERROR_4);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
}
?>