<?php
class ControllerRol {
	
   	public function getRolById(){
 		try{
  	   		$id = getParam('id');
    			if (is_null($id)) {
     				$id = 0;
     			}
     		printSuccessLog('Buscando id:'.$id,get_class($this),__FUNCTION__);
			$data = Rol::find($id);
			printSuccessLog('Encontro id:'.$id,get_class($this),__FUNCTION__);
			processSuccess($data->to_json());
			printSuccessLog('Exito    id:'.$id,get_class($this),__FUNCTION__);

			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,ROL_ERROR_1);
       			 printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
	public function createRol(){
		$rol = new Rol();
		$rol->descripcion = getParam('descripcion');
		try{
			$ret = $rol->save();
			if($ret == false){
		   		 processFailed(ERR,ROL_ERROR_2);
		  		 exit(0);
			}else{
                 processSuccess(ROL_SUCCES_1);
		  		 exit(0);
			}
		}catch(ActiveRecord\DatabaseException $e){
		    processFailed(ERR,ROL_ERROR_2);
		    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		    exit(0);
		}
	}

	public function updateRol(){
		try{
			$rol = Rol::find(getParam('idRol'));
		        if(!is_null(getParam('descripcion')) || strlen(getParam('descripcion')) > 0){
					$rol->descripcion = getParam('descripcion');
		        }
			try{
				$ret = $rol->save();
			}catch(ActiveRecord\DatabaseException $e){
		 	    processFailed(ERR,ROL_ERROR_3);
		 		printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		        exit(0);
			}

			if($ret == false){
		   		 processFailed(ERR,ROL_ERROR_3);
		  		 exit(0);
			}else{
                 processSuccess(ROL_SUCCES_2);
		  		 exit(0);
			}
		}catch(ActiveRecord\RecordNotFound $e){
			processFailed(ERR,ROL_ERROR_4);
            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            exit(0);
		}
	}

	public function listRol(){
		 try{
			$data = Rol::find('all');
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			$concac = substr($concac, 0, strlen($concac) - 1);
			processSuccess($concac);
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,ROL_ERROR_5);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
}
?>