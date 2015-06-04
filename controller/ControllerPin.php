<?php
class ControllerPin{

	public function createPin(){
		$pin = new Pin();
		$pin->globalmx_tarjeta_numero = getParam('numero');
		$pin->codigo = getParam('codigo');
		try{
			$ret = $pin->save();
			if($ret == false){
		   		 processFailed(ERR,PIN_ERROR_1);
		  		 exit(0);
			}else{
                 processSuccess(PIN_SUCCES_1);
		  		 exit(0);
			}
		}catch(ActiveRecord\DatabaseException $e){
		    processFailed(ERR,PIN_ERROR_1);
		    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		    exit(0);
		}
	}

	public function updatePin(){
		try{
			$pin = Pin::find(getParam('idPin'));
		        if(!is_null(getParam('numero')) || strlen(getParam('numero')) > 0){
					$pin->globalmx_tarjeta_numero = getParam('numero');
		        }
		        if(!is_null(getParam('codigo')) || strlen(getParam('codigo')) > 0){
					$pin->codigo = getParam('codigo');
		        }
		        if(!is_null(getParam('vencimiento')) || strlen(getParam('vencimiento')) > 0){
					$pin->fecha_vencimiento = getParam('vencimiento');
		        }
			try{
				$ret = $pin->save();
			}catch(ActiveRecord\DatabaseException $e){
		 	    processFailed(ERR,PIN_ERROR_2);
		 		printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		        exit(0);
			}

			if($ret == false){
		   		 processFailed(ERR,PIN_ERROR_2);
		  		 exit(0);
			}else{
                 processSuccess(PIN_SUCCES_2);
		  		 exit(0);
			}
		}catch(ActiveRecord\RecordNotFound $e){
			processFailed(ERR,PIN_ERROR_3);
            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            exit(0);
		}
	}

	public function listPin(){
		 try{
			$data = Pin::find('all');
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			$concac = substr($concac, 0, strlen($concac) - 1);
			processSuccess($concac);
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,PIN_ERROR_4);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
}
?>