<?php
class ControllerVendedor{

	public function createVendedor(){
		$vendedor = new Vendedor();
		$vendedor->cedula = getParam('cedula');
		$vendedor->nombres = getParam('nombres');
		$vendedor->apellidos = getParam('apellidos');
		$vendedor->telefono = getParam('telefono');
		$vendedor->correo_electronico = getParam('correo');
		try{
			$ret = $vendedor->save();
			if($ret == false){
		   		 processFailed(ERR,VENDEDOR_ERROR_1);
		  		 exit(0);
			}else{
                 processSuccess(VENDEDOR_SUCCES_1);
		  		 exit(0);
			}
		}catch(ActiveRecord\DatabaseException $e){
		    processFailed(ERR,VENDEDOR_ERROR_1);
		    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		    exit(0);
		}
	}

	public function updateVendedor(){
		try{
			$vendedor = Vendedor::find(getParam('idVendedor'));
		        if(!is_null(getParam('cedula')) || strlen(getParam('cedula')) > 0){
					$vendedor->cedula = getParam('cedula');
		        }
		        if(!is_null(getParam('nombres')) || strlen(getParam('nombres')) > 0){
					$vendedor->nombres = getParam('nombres');
		        }
		        if(!is_null(getParam('apellidos')) || strlen(getParam('apellidos')) > 0){
					$vendedor->apellidos = getParam('apellidos');
		        }
		        if(!is_null(getParam('telefono')) || strlen(getParam('telefono')) > 0){
					$vendedor->telefono = getParam('telefono');
		        }
		        if(!is_null(getParam('correo')) || strlen(getParam('correo')) > 0){
					$vendedor->correo_electronico = getParam('correo');
		        }
			try{
				$ret = $vendedor->save();
			}catch(ActiveRecord\DatabaseException $e){
		 	    processFailed(ERR,VENDEDOR_ERROR_2);
		 		printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		        exit(0);
			}
			if($ret == false){
		   		 processFailed(ERR,VENDEDOR_ERROR_2);
		  		 exit(0);
			}else{
                 processSuccess(VENDEDOR_SUCCES_2);
		  		 exit(0);
			}
		}catch(ActiveRecord\RecordNotFound $e){
			processFailed(ERR,VENDEDOR_ERROR_3);
            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            exit(0);
		}
	}

	public function listVendedor(){
		 try{
			$data = Vendedor::find('all');
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			$concac = substr($concac, 0, strlen($concac) - 1);
			processSuccess($concac);
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,VENDEDOR_ERROR_4);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }

    public function listVendedorByCedula(){
        try{
            $id = getParam('cedula');
                if (is_null($id)) {
                    $id = 0;
                }
            printSuccessLog('Buscando id:'.$id,get_class($this),__FUNCTION__);
            $data = Vendedor::find_by_cedula($id);
            printSuccessLog('Encontro id:'.$id,get_class($this),__FUNCTION__);
            processSuccess($data->to_json());
            printSuccessLog('Exito    id:'.$id,get_class($this),__FUNCTION__);
            } catch (ActiveRecord\RecordNotFound $e) {
                processFailed(NO_EXIST,VENDEDOR_ERROR_4);
                printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            }
    }

}
?>