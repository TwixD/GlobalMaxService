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


	public function consultaTarjeta(){	
			securityAccess($_SERVER['REMOTE_ADDR'],getParam('trama'),getParam('nit'),get_class($this),__FUNCTION__);
			$numTarjeta = getParam('numTarjeta');
			$estado = getParam('estado');
			//Consulta todas las tarjetas
			if(is_null($numTarjeta)){
				//Consulta todas las tarjetas indiferentemente del estado.
				if(is_null($estado)){
		     			try{
		     				$data = Tarjeta::find('all');
							$concact = null;
						      	foreach ($data as $key) {
					   				$json = $key->to_json();
					   				$concac.=$json.',';
								}
							processSuccess($concac);
							printSuccessLog('Imprime Tarjetas.',get_class($this),__FUNCTION__);
		     			} catch (ActiveRecord\RecordNotFound $e) {
							processFailed(NO_EXIST,TARJETA_ERROR_2);
		       				printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		       				exit(0);
						}
				//Busqueda de tarjetas por estado
		     	}else{
				     	try{
		     				$data = Tarjeta::find('all',
		     					array('conditions' => array('globalmx_estado_id_estado = ?',
							$estado
						 	)));
		                if(count($data)==0){
		                    processFailed(NO_EXIST,ESTADO_ERROR_1);
		                    printErrorLog(ESTADO_ERROR_1,get_class($this),__FUNCTION__);
		                    exit(0);
		                }else{
		                	$concact = null;
						    foreach ($data as $key) {
					   				$json = $key->to_json();
					   				$concac.=$json.',';
							}
							processSuccess($concac);
		                    printSuccessLog('Imprime '.count($data ). ' registros.',get_class($this),__FUNCTION__);
		                }

		     			} catch (ActiveRecord\RecordNotFound $e) {
							processFailed(NO_EXIST,TARJETA_ERROR_2);
		       				printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		       				exit(0);
						}
		     	}
			}else{
		     			try{
		     				$data = Tarjeta::find($numTarjeta);
							processSuccess($data->to_json());
		                 	printSuccessLog('Exito consultando tarjeta :'.$numTarjeta,get_class($this),__FUNCTION__);
		     			} catch (ActiveRecord\RecordNotFound $e) {
							processFailed(NO_EXIST,TARJETA_ERROR_2);
		       				printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
		       				exit(0);
						}
			}
	}
	/*
		@Descripcion: Funcion que sirve para realizar transacciones
 		@params : -nit: Nit de la empresa
 				  -trama: Trama de la empresa a conectar
 				  -tarjeta: Numero de tarjeta que va estar la relaccion.
 				  -valor: Es el valor de la recarga, si es compra toma el valor de la tarjeta
 				  -punto: Es el punto de venta donde se realiza la transaccion
    */
	public function managerTransation(){
		printTransationLog('-------------Inicio de transaccion-------------',get_class($this),__FUNCTION__);
		$nit = getParam('nit');
		//Modulo de seguridad.
		securityAccessT($_SERVER['REMOTE_ADDR'],getParam('trama'),$nit,get_class($this),__FUNCTION__);
		//Variables
		printTransationLog('Conexion segura',get_class($this),__FUNCTION__);
		$numTarjeta = getParam('tarjeta');
		$valor = getParam('valor');
		$puntoVenta = getParam('punto');
		//Si no ingresan el punto de venta.
		if(is_null($puntoVenta)){
			printTransationLog('Punto de venta no asignado',get_class($this),__FUNCTION__);
			$puntoVenta = 0;
		}
		//Si no ingresa el numero de tarjeta.
		if(is_null($numTarjeta)){
			printTransationLog('Numero de tarjeta vacio',get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,TARJETA_ERROR_1);
			exit(0);
		}
     	try{
     		//Busca el numero de tarjeta seleccionado.
     		$data = Tarjeta::find($numTarjeta);
            printTransationLog('Tarjeta numero:['.$numTarjeta.'] Valida',get_class($this),__FUNCTION__);
     	} catch (ActiveRecord\RecordNotFound $e) {
     		//El numero de tarjeta no se encuentra registro en la base de datos.
     		printTransationLog('Numero de tarjeta invalido',get_class($this),__FUNCTION__);
			processFailed(NO_EXIST,TARJETA_ERROR_2);
       		exit(0);
		}
		//Valida el tipo de transaccion a realizar
		switch ($data->globalmx_estado_id_estado) {
			//Recarga
			case "1":
			case "3":
			    printTransationLog('Tipo transaccion [RECARGA]',get_class($this),__FUNCTION__);
			    $tipoTransaccion = 2;
			    //Verifica que se ingrese un valor a recargar
				if(is_null($valor)){
					//No ingresan el valor de recarga.
					printTransationLog('No tiene valor de recarga',get_class($this),__FUNCTION__);
                    processFailed(ADV,TRANSA_ERROR_1);
			        exit(0);
		        }
		        //Verifica el valor minimo a recargar.
		        if($valor < MIN_RECARGA ){
		        	//No tiene el valor minimo a recargar
		        	printTransationLog(TRANSA_ERROR_2.MIN_RECARGA,get_class($this),__FUNCTION__);
                    processFailed(ADV,TRANSA_ERROR_2.MIN_RECARGA);
			        exit(0);
		        }
		        //Verifique el valor maximo a recargar
		        if($valor > MAX_RECARGA){
		        	//Excede el valor maximo a recargar
		        	printTransationLog(TRANSA_ERROR_3.MAX_RECARGA,get_class($this),__FUNCTION__);
                    processFailed(ADV,TRANSA_ERROR_3.MAX_RECARGA);
			        exit(0);
		        }
		        //Guarda en la clase de Transaccion los valores ingresados.
		        printTransationLog('Informacion de transaccion:',get_class($this),__FUNCTION__);
		        $transaccion = new Transaccion();
		        $transaccion->globalmx_tarjeta_numero = $numTarjeta;
		        $transaccion->tipo_transaccion = $tipoTransaccion;
		        $transaccion->globalmx_empresa_nit = $nit;
		        $transaccion->valor = $valor;
		        $transaccion->punto_venta = $puntoVenta;
		        printTransationLog('-Numero tarjeta  :'.$transaccion->globalmx_tarjeta_numero,get_class($this),__FUNCTION__);
		        printTransationLog('-Tipo transaccion:'.$transaccion->tipo_transaccion,get_class($this),__FUNCTION__);
		        printTransationLog('-Nit empresa     :'.$transaccion->globalmx_empresa_nit,get_class($this),__FUNCTION__);
			    printTransationLog('-Valor           :'.$transaccion->valor,get_class($this),__FUNCTION__);
			    printTransationLog('-Punto de venta  :'.$transaccion->punto_venta,get_class($this),__FUNCTION__);
		   		try{
		   			//Guarda la transaccion en la tabla globalmx_transaccion.
		        	$retorno = $transaccion->save();
		  	        printTransationLog('Transaccion de recarga Exitosa.',get_class($this),__FUNCTION__);
		       		processSuccess(TRANS_SUCCES_1);
					printTransationLog('----------------Fin transaccion----------------',get_class($this),__FUNCTION__);
		        }catch(Exception $e) {
		        	//La transaccion no se pudo guardar.
		        	printTransationLog(TRANSA_ERROR_4,get_class($this),__FUNCTION__);
                 	processFailed(ADV,TRANSA_ERROR_4);
                 	exit(0);
                }          
				break;
			//Compra
			case '2':
			    printTransationLog('Tipo transaccion [COMPRA]',get_class($this),__FUNCTION__);
			    $tipoTransaccion = 1;
			    printTransationLog('Informacion de transaccion:',get_class($this),__FUNCTION__);
			    $transaccion = new Transaccion();
		        $transaccion->globalmx_tarjeta_numero = $numTarjeta;
		        $transaccion->tipo_transaccion = $tipoTransaccion;
		        $transaccion->globalmx_empresa_nit = $nit;
		        $transaccion->valor = $data->precio;
		        $transaccion->punto_venta = $puntoVenta;
		        printTransationLog('-Numero tarjeta  :'.$transaccion->globalmx_tarjeta_numero,get_class($this),__FUNCTION__);
		        printTransationLog('-Tipo transaccion:'.$transaccion->tipo_transaccion,get_class($this),__FUNCTION__);
		        printTransationLog('-Nit empresa     :'.$transaccion->globalmx_empresa_nit,get_class($this),__FUNCTION__);
			    printTransationLog('-Valor           :'.$transaccion->valor,get_class($this),__FUNCTION__);
			    printTransationLog('-Punto de venta  :'.$transaccion->punto_venta,get_class($this),__FUNCTION__);
		   		$pin2 = Pin::find_by_globalmx_tarjeta_numero($numTarjeta);
                if(count($pin2)==0){
                    $pinAsing = '0000';
       			    printTransationLog(PIN_ERROR_3,get_class($this),__FUNCTION__);
			    }else{
			     	$pinAsing = $pin2->codigo;		
			    }
		   		try{
		   			//Guarda la transaccion.
		        	$retorno = $transaccion->save();
		        	$data->globalmx_estado_id_estado = 3;
		        	$data->save();
		        	printTransationLog('Transaccion de compra Exitosa. Pin activacion :'.$pinAsing,get_class($this),__FUNCTION__);
		       		processSuccess(MSG_JSON.$pinAsing.MSG_JSON2);
					printTransationLog('----------------Fin transaccion----------------',get_class($this),__FUNCTION__);
		        }catch(Exception $e) {
		        	//No puede realizar la transaccion
		        	printTransationLog(TRANSA_ERROR_4,get_class($this),__FUNCTION__);
                 	processFailed(ADV,TRANSA_ERROR_4);
                }       
				break;
			
			default:
			    //Ingresa un estado que no esta relacionado en globalmx_estado
				processFailed(WRONG_CAMP,ESTADO_ERROR_1);
				printTransationLog(ESTADO_ERROR_1,get_class($this),__FUNCTION__);
				exit(0);
				break;
		}
	}
	/*
		@Descripcion: Funcion para consultar el tipo de transaccion disponible por tarjeta
 		@params : -nit: Nit de la empresa
 				  -trama: Trama de la empresa a conectar
 				  -tarjeta: Numero de tarjeta que va estar la relaccion.
    */
	public function tipoTransation(){
		printTransationLog('-------------TIPO TRANSACCION-------------',get_class($this),__FUNCTION__);
	    $nit = getParam('nit');
		//Modulo de seguridad.
		securityAccessT($_SERVER['REMOTE_ADDR'],getParam('trama'),$nit,get_class($this),__FUNCTION__);
		//Variables
		printTransationLog('Conexion segura',get_class($this),__FUNCTION__);
		$numTarjeta = getParam('tarjeta');
		//Si no ingresa el numero de tarjeta.
		if(is_null($numTarjeta)){
			printTransationLog('Numero de tarjeta vacio',get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,TARJETA_ERROR_1);
			exit(0);
		}
		try{
     		//Busca el numero de tarjeta seleccionado.
     		$data = Tarjeta::find($numTarjeta);
            printTransationLog('Tarjeta numero:['.$numTarjeta.'] Valida',get_class($this),__FUNCTION__);
     	} catch (ActiveRecord\RecordNotFound $e) {
     		//El numero de tarjeta no se encuentra registro en la base de datos.
     		printTransationLog('Numero de tarjeta invalido',get_class($this),__FUNCTION__);
			processFailed(NO_EXIST,TARJETA_ERROR_2);
       		exit(0);
		}
		//Valida el tipo de transaccion a realizar
		switch ($data->globalmx_estado_id_estado) {
			//Recarga
			case "1":
			case "3":
			processSuccess(MSG_JSON.'2'.MSG_JSON2);
			printTransationLog('Tipo transaccion [RECARGA]',get_class($this),__FUNCTION__);
			printTransationLog('----------------FIN CONSULTA----------------',get_class($this),__FUNCTION__);
			break;
			//Compra
			case '2':
			processSuccess(MSG_JSON.$data->precio.MSG_JSON2);
			printTransationLog('Tipo transaccion [COMPRA]',get_class($this),__FUNCTION__);
			printTransationLog('----------------FIN CONSULTA----------------',get_class($this),__FUNCTION__);
			break;
			default:
			//Ingresa un estado que no esta relacionado en globalmx_estado
			processFailed(WRONG_CAMP,ESTADO_ERROR_1);
			printTransationLog(ESTADO_ERROR_1,get_class($this),__FUNCTION__);
			exit(0);
			break;
		}
	}
}
?>