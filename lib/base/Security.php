<?php
        function securityAccess($serverIP = null ,$trama = null,$nit = null,$class,$fn){
          		$emp = Empresa::find('all',
				array('conditions' => array(
					'nit = ? AND ip = ? AND trama = ?',
					$nit,
					$serverIP,
					$trama
				 )));
          		if(count($emp)==0){
          			if(is_null($nit) && is_null($trama)){
       			    printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-1",$class,$fn);
          			exit(0);
          			}else{
          				if(!is_null($nit) && is_null($trama)){
          				   printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-2",$class,$fn);
						   exit(0);          				
          				}else{
          					if(is_null($nit) && !is_null($trama)){
          				   printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-2",$class,$fn);
          				   exit(0);	
          					}else{
       			           printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-3",$class,$fn);
          				   exit(0);
          					}
          				}
       			    } 
				}
    	}
        function securityAccessT($serverIP = null ,$trama = null,$nit = null,$class,$fn){
              $emp = Empresa::find('all',
        array('conditions' => array(
          'nit = ? AND ip = ? AND trama = ?',
          $nit,
          $serverIP,
          $trama
         )));
              if(count($emp)==0){
                if(is_null($nit) && is_null($trama)){
                printTransationLog('Conexion insegura bloqueada.',$class,$fn);
                printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-1",$class,$fn);
                exit(0);
                }else{
                  if(!is_null($nit) && is_null($trama)){
                     printTransationLog('Conexion insegura bloqueada.',$class,$fn);
                     printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-2",$class,$fn);
               exit(0);                 
                  }else{
                    if(is_null($nit) && !is_null($trama)){
                     printTransationLog('Conexion insegura bloqueada.',$class,$fn);
                     printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-2",$class,$fn);
                     exit(0); 
                    }else{
                       printTransationLog('Conexion insegura bloqueada.',$class,$fn);
                       printSecurityLog(HACK_1.$serverIP.HACK_2.$trama.HACK_3.$nit."] Risk Level-3",$class,$fn);
                     exit(0);
                    }
                  }
                } 
        }
      }
?>