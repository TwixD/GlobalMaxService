<?php
class ControllerPersona {

	public function createPersona(){
      
        printSuccessLog('Ingreso al metodo.' ,get_class($this),__FUNCTION__);
        $persona = new Persona();
        $persona->cedula = getParam('cedula');
        $persona->globalmx_tarjeta_numero = getParam('tarjeta');
        $persona->globalmx_ciudad_cityid = getParam('ciudad');
        $persona->nombre = getParam('nombre');
        $persona->apellido = getParam('apellido');
        $persona->nombre2 = getParam('nombre2');
        $persona->apellido2 = getParam('apellido2');
        $persona->direccion = getParam('direccion');
        $persona->barrio = getParam('barrio');
        $persona->telefono = getParam('telefono');
        $persona->celular = getParam('celular');
        $persona->email = getParam('email');
        $persona->codigo_postal = getParam('codigo_postal');
        $persona->fecha_nacimiento = getParam('fecha_nacimiento');
        $numberPin = getParam('pin');
       
        if(is_null($persona->cedula) || strlen($persona->cedula) <=1){
        	printErrorLog(PERSONA_ERROR_1,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_1);
            exit(0);
        }
        if(is_null($persona->globalmx_tarjeta_numero) || strlen($persona->globalmx_tarjeta_numero) <=1){
        	printErrorLog(PERSONA_ERROR_2,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_2);
            exit(0);
        }
        if(is_null($numberPin) || strlen($numberPin) <=3){
            printErrorLog(PIN_ERROR_2,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PIN_ERROR_2);
            exit(0);
        }
        if(is_null($persona->globalmx_ciudad_cityid) || strlen($persona->globalmx_ciudad_cityid) == 0 || $persona->globalmx_ciudad_cityid == 0){
        	printErrorLog(PERSONA_ERROR_3,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_3);
            exit(0);
        }
        if(is_null($persona->nombre) || strlen($persona->nombre) == 0){
        	printErrorLog(PERSONA_ERROR_4,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_4);
            exit(0);
        }
        if(is_null($persona->apellido) || strlen($persona->apellido) == 0){
        	printErrorLog(PERSONA_ERROR_5,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_5);
            exit(0);
        }
        if(is_null($persona->direccion) || strlen($persona->direccion) == 0){
        	printErrorLog(PERSONA_ERROR_6,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_6);
            exit(0);
        }
        if(is_null($persona->barrio) || strlen($persona->barrio	) == 0){
        	printErrorLog(PERSONA_ERROR_7,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_7);
            exit(0);
        }
        if(is_null($persona->telefono) || strlen($persona->telefono) == 0 || $persona->telefono == 0){
        	printErrorLog(PERSONA_ERROR_8,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_8);
            exit(0);
        }
        if(is_null($persona->celular) || strlen($persona->celular) == 0 || $persona->celular == 0){
        	printErrorLog(PERSONA_ERROR_9,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_9);
            exit(0);
        }
        if(is_null($persona->email) || strlen($persona->email) == 0){
        	printErrorLog(PERSONA_ERROR_10,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_10);
            exit(0);
        }
        if(is_null($persona->fecha_nacimiento) || strlen($persona->cedula) == 0){
        	printErrorLog(PERSONA_ERROR_11,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,PERSONA_ERROR_11);
            exit(0);
        }

        $persona->cedula = getParam('cedula');
        $persona->globalmx_tarjeta_numero = getParam('tarjeta');
        $persona->globalmx_ciudad_cityid = getParam('ciudad');
        $persona->nombre = getParam('nombre');
        $persona->apellido = getParam('apellido');
        $persona->nombre2 = getParam('nombre2');
        $persona->apellido2 = getParam('apellido2');
        $persona->direccion = getParam('direccion');
        $persona->barrio = getParam('barrio');
        $persona->telefono = getParam('telefono');
        $persona->celular = getParam('celular');
        $persona->email = getParam('email');
        $persona->codigo_postal = getParam('codigo_postal');
        $persona->fecha_nacimiento = getParam('fecha_nacimiento');
        printSuccessLog('CAMPOS',get_class($this),__FUNCTION__);
        printSuccessLog('CEDULA         ['.$persona->cedula.']',get_class($this),__FUNCTION__);
        printSuccessLog('TARJETA        ['.$persona->globalmx_tarjeta_numero.']',get_class($this),__FUNCTION__); 
        printSuccessLog('CIUDAD         ['.$persona->globalmx_ciudad_cityid.']',get_class($this),__FUNCTION__);
        printSuccessLog('NOMBRE         ['.$persona->nombre.']',get_class($this),__FUNCTION__);
        printSuccessLog('APELLIDO       ['.$persona->apellido.']',get_class($this),__FUNCTION__);
        printSuccessLog('NOMBRE2        ['.$persona->nombre2.']',get_class($this),__FUNCTION__);
        printSuccessLog('APELLIDO2      ['.$persona->apellido2.']',get_class($this),__FUNCTION__);
        printSuccessLog('DIRECCION      ['.$persona->direccion.']',get_class($this),__FUNCTION__);
        printSuccessLog('BARRIO         ['.$persona->barrio.']',get_class($this),__FUNCTION__);
        printSuccessLog('TELEFONO       ['.$persona->telefono.']',get_class($this),__FUNCTION__);
        printSuccessLog('CELULAR        ['.$persona->celular.']',get_class($this),__FUNCTION__);
        printSuccessLog('EMAIL          ['.$persona->email.']',get_class($this),__FUNCTION__);
        printSuccessLog('CODIGOPOSTAL   ['.$persona->codigo_postal.']',get_class($this),__FUNCTION__);
        printSuccessLog('FECHANACIMIENTO['.$persona->fecha_nacimiento.']',get_class($this),__FUNCTION__);
        try{
            Tarjeta::find($persona->globalmx_tarjeta_numero);
                printSuccessLog('->La tarjeta fue encontrada.',get_class($this),__FUNCTION__);
            $p = Persona::find('first',
                        array('conditions' => array('cedula = ?', $persona->cedula)));
                printSuccessLog('->Buscando cedula de persona.',get_class($this),__FUNCTION__);
            if(is_null($p)){
                printSuccessLog('->La persona no se encuentra registrada[OK]',get_class($this),__FUNCTION__);
            $data = Persona::find('first',
                        array('conditions' => array('globalmx_tarjeta_numero = ?', $persona->globalmx_tarjeta_numero)));
          		if(count($data)==0){
          			try{
          				Ciudad::find($persona->globalmx_ciudad_cityid);
          				$ret = $persona->save();
          				if ($ret == false)
                        {
                        	$cedulaError = $persona->errors->on('cedula');
                        	$tarjetaError = $persona->errors->on('globalmx_tarjeta_numero');
                        	$ciudadError = $persona->errors->on('globalmx_ciudad_cityid');
                        	$nombreError = $persona->errors->on('nombre');
                        	$apellidoError = $persona->errors->on('apellido');
                        	$direccionError = $persona->errors->on('direccion');
                        	$barrioError = $persona->errors->on('barrio');
                        	$telefonoError = $persona->errors->on('telefono');
                        	$celularError = $persona->errors->on('celular');
                        	$emailError = $persona->errors->on('email');
                        	    if(is_null($cedulaError)){
                        	    if(is_null($tarjetaError)){
                        	    if(is_null($ciudadError)){
                        	    if(is_null($nombreError)){
                        	    if(is_null($apellidoError)){
                        	    if(is_null($direccionError)){
                        	    if(is_null($barrioError)){
                        	    if(is_null($telefonoError)){
                        	    if(is_null($celularError)){
                        	    if(is_null($emailError)){
									processFailed(ADV,TOTAL_FAILED);
									printErrorLog(TOTAL_FAILED,get_class($this),__FUNCTION__);
                                }else{
 									processFailed(ADV,$emailError);
									printErrorLog($emailError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$celularError);
									printErrorLog($celularError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$telefonoError);
									printErrorLog($telefonoError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$barrioError);
									printErrorLog($barrioError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$direccionError);
									printErrorLog($direccionError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$apellidoError);
									printErrorLog($apellidoError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$nombreError);
									printErrorLog($nombreError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$ciudadError);
									printErrorLog($ciudadError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$tarjetaError);
									printErrorLog($tarjetaError,get_class($this),__FUNCTION__);
                                }
                                }else{
 									processFailed(ADV,$cedulaError);
									printErrorLog($cedulaError,get_class($this),__FUNCTION__);
                                }
                        }else{
                                $tarjeta = Tarjeta::find($persona->globalmx_tarjeta_numero);
                                $tarjeta->update_attributes(array('globalmx_estado_id_estado' => 1, 'numero' => $persona->globalmx_tarjeta_numero));
                                printSuccessLog('->Actualizando a estado ACTIVADO[1]',get_class($this),__FUNCTION__);
                                sendMail($persona);
                                $pin = Pin::find('first',
                                array('conditions' => array('codigo = ?', $numberPin)));
                                $pin->delete();
                                processSuccess(PERSONA_SUCCES_1);
                                printSuccessLog('Persona Creada : ['.$persona->cedula.']',get_class($this),__FUNCTION__);
                        }
          			}catch(ActiveRecord\RecordNotFound $e){
		                processFailed(NO_EXIST,CIUDAD_ERROR_2);
		                printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		      			exit(0);
          			}
            	}else{
                    processFailed(EXIST_DATA,TARJETA_ERROR_2);
                    printErrorLog(TARJETA_ERROR_2,get_class($this),__FUNCTION__);
                    exit(0);
           		}
            }else{
                    processFailed(EXIST_DATA,PERSONA_ERROR_12);
                    printErrorLog(PERSONA_ERROR_12,get_class($this),__FUNCTION__);
                    exit(0);
            }

           } catch (ActiveRecord\RecordNotFound $e) {
                processFailed(NO_EXIST,TARJETA_ERROR_2);
                printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
      			exit(0);
		   }        
    }
}
?>
