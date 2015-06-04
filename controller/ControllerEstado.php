<?php
class ControllerEstado{

	public function createEstado(){
		$estado = new Estado();
		$estado->descripcion = getParam('descripcion');
		try{
			$ret = $estado->save();
			if($ret == false){
		   		 processFailed(ERR,ESTADO_ERROR_5);
		  		 exit(0);
			}else{
                 processSuccess(ESTADO_SUCCES_1);
		  		 exit(0);
			}
		}catch(ActiveRecord\DatabaseException $e){
		    processFailed(ERR,ESTADO_ERROR_5);
		    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		    exit(0);
		}
	}

	public function updateEstado(){
		try{
			$estado = Estado::find(getParam('idEstado'));
		        if(!is_null(getParam('descripcion')) || strlen(getParam('descripcion')) > 0){
					$estado->descripcion = getParam('descripcion');
		        }
			try{
				$ret = $estado->save();
			}catch(ActiveRecord\DatabaseException $e){
		 	    processFailed(ERR,ESTADO_ERROR_2);
		 		printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		        exit(0);
			}

			if($ret == false){
		   		 processFailed(ERR,ESTADO_ERROR_2);
		  		 exit(0);
			}else{
                 processSuccess(ESTADO_SUCCES_2);
		  		 exit(0);
			}
		}catch(ActiveRecord\RecordNotFound $e){
			processFailed(ERR,ESTADO_ERROR_3);
            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            exit(0);
		}
	}

	public function listEstado(){
		 try{
			$data = Estado::find('all');
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			$concac = substr($concac, 0, strlen($concac) - 1);
			processSuccess($concac);
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,ESTADO_ERROR_4);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
}
?>