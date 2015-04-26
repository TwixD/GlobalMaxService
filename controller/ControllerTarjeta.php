<?php
class ControllerTarjeta{
	/*	
		@Descripcion: Funcion que sirve para activar las tarjetas de GlobalMax
 		@params : -numTarjeta : Es el numero de la tarjeta
 				  -numPin : Es el numero de pin de activacion para la tarjeta
    */
	public function activeTarjetaStep1(){
			printSuccessLog('Entro metodo',get_class($this),__FUNCTION__);
		 try{
		 	$numTarjeta = getParam('numTarjeta');
		 	$numPin = getParam('numPin');
		 		//Valida si se ingreso el numero de tarjeta
    			if (is_null($numTarjeta)) {
    				printErrorLog(TARJETA_ERROR_1,get_class($this),__FUNCTION__);
     				processFailed(EMPTY_FIELD,TARJETA_ERROR_1);
     				exit(0);
     			}
     			//Valida si se ingreso el numero de pin
     			if(is_null($numPin)){
     				printErrorLog(PIN_ERROR_1,get_class($this),__FUNCTION__);
     				processFailed(EMPTY_FIELD,PIN_ERROR_1);
     				exit(0);
     			}
			printSuccessLog('Ingreso Tarjeta : '.$numTarjeta . ' Pin :' . $numPin ,get_class($this),__FUNCTION__);
     		try{
     		$data = Tarjeta::find($numTarjeta);
     		} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,TARJETA_ERROR_2);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
       			exit(0);
			}
			//Valida que el estado sea 3 : que la tarjeta fue comprada.
			if($data->globalmx_estado_id_estado == 3){
				$pin = Pin::find('all',
				array('conditions' => array('globalmx_tarjeta_numero = ? AND codigo = ?',
					$numTarjeta,
					$numPin
				 )));
				#Valida si el pin corresponde al numero de tarjeta
				if(count($pin)==0){
					processFailed(NO_EXIST,PIN_ERROR_2);
       			    printErrorLog(PIN_ERROR_2.$numPin,get_class($this),__FUNCTION__);
       			    exit(0);
				}else{
					//Operacion Exitosa, el pin corresponde con la tarjeta ACCESS GRANTED
					processSuccess($data->to_json());
			        printSuccessLog('Acceso permitido. Tarjeta : ['.$numTarjeta.'] Pin : ['.$numPin . ']',get_class($this),__FUNCTION__);
				}
			}else{
				processFailed(NO_EXIST,TARJETA_ERROR_3);
				printErrorLog(TARJETA_ERROR_3.$numPin,get_class($this),__FUNCTION__);
       			exit(0);
			}
			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,TARJETA_ERROR_2);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
	}
}
?>