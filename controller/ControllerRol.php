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
}
?>