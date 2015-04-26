<?php
class ControllerCiudad{
	public function getCiudadByRegion(){
		 try{
		 	$idRegion = getParam('idRegion');
    			if (is_null($idRegion)) {
     				$idRegion = 0;
     			}
     		printSuccessLog('Entro metodo    :'.$idRegion,get_class($this),__FUNCTION__);
			$data = Ciudad::find('all', array('conditions' => array('RegionID in (?)', array($idRegion)) , 'select' => 'CityId,City') );
			printSuccessLog('Encontro Ciudad :'.$idRegion,get_class($this),__FUNCTION__);
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			processSuccess($concac);
			printSuccessLog('Imprime Ciudad  :'.$idRegion,get_class($this),__FUNCTION__);

			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,CIUDAD_ERROR_1);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
	}
}
?>