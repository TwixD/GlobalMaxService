<?php
class ControllerRegion{
	public function getRegionByPais(){
		 try{
		 	$idPais = getParam('idPais');
    			if (is_null($idPais)) {
     				$idPais = 0;
     			}
     		printSuccessLog('Entro metodo    :'.$idPais,get_class($this),__FUNCTION__);
			$data = Region::find('all', array('conditions' => array('CountryId in (?)', array($idPais)) , 'select' => 'RegionId,Region') );
			printSuccessLog('Encontro Region :'.$idPais,get_class($this),__FUNCTION__);
			$concact = null;
		      	foreach ($data as $key) {
	   				$json = $key->to_json();
	   				$concac.=$json.',';
				}
			processSuccess($concac);
			printSuccessLog('Imprime Region  :'.$idPais,get_class($this),__FUNCTION__);

			} catch (ActiveRecord\RecordNotFound $e) {
				processFailed(NO_EXIST,REGION_ERROR_1);
       			printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
	}
}
?>