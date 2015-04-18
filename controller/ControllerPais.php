<?php
class ControllerPais {
	public function getAllPais(){
		 try{
     		printSuccessLog('Entro metodo....',get_class($this),__FUNCTION__);
			$data = Pais::find('all', array('select' => 'CountryId,Country'));
			printSuccessLog('Encontro paises.',get_class($this),__FUNCTION__);
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			processSuccess($concac);
			printSuccessLog('Imprime Paises.',get_class($this),__FUNCTION__);

			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,PAIS_ERROR_1);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }
}
?>