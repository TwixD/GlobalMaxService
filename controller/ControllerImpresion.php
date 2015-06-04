<?php
class ControllerImpresion{

	public function createImpresion(){
		$impresion = new Impresion();
		$impresion->codigo = getParam('codigo');
		$impresion->descripcion = getParam('descripcion');
		try{
			$ret = $impresion->save();
			if($ret == false){
		   		 processFailed(ERR,IMPRESION_ERROR_1);
		  		 exit(0);
			}else{
                 processSuccess(IMPRESION_SUCCES_1);
		  		 exit(0);
			}
		}catch(ActiveRecord\DatabaseException $e){
		    processFailed(ERR,IMPRESION_ERROR_1);
		    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		    exit(0);
		}
	}

	public function updateImpresion(){
		try{
			$impresion = Impresion::find(getParam('idglobalmxImpresion'));
		        if(!is_null(getParam('descripcion')) || strlen(getParam('descripcion')) > 0){
					$impresion->descripcion = getParam('descripcion');
		        }
		        if(!is_null(getParam('codigo')) || strlen(getParam('codigo')) > 0){
					$impresion->codigo = getParam('codigo');
		        }
			try{
				$ret = $impresion->save();
			}catch(ActiveRecord\DatabaseException $e){
		 	    processFailed(ERR,IMPRESION_ERROR_2);
		 		printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		        exit(0);
			}

			if($ret == false){
		   		 processFailed(ERR,IMPRESION_ERROR_2);
		  		 exit(0);
			}else{
                 processSuccess(IMPRESION_SUCCES_2);
		  		 exit(0);
			}
		}catch(ActiveRecord\RecordNotFound $e){
			processFailed(ERR,IMPRESION_ERROR_3);
            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            exit(0);
		}
	}

	public function listImpresion(){
		 try{
			$data = Impresion::find('all');
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			$concac = substr($concac, 0, strlen($concac) - 1);
			processSuccess($concac);
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,IMPRESION_ERROR_4);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
}
?>