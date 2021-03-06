<?php
class ControllerUsuario {

	   	public function validateUser(){
	   	printSuccessLog('Ingreso al metodo.' ,get_class($this),__FUNCTION__);
 		try{
  	   		$user = getParam('user');
            $password = getParam('password');

    			if (is_null($user)) {
    				printErrorLog(USUARIO_ERROR_1,get_class($this),__FUNCTION__);
     				processFailed(EMPTY_FIELD,USUARIO_ERROR_1);
     				exit(0);
     			}

     			if (is_null($password)) {
    				printErrorLog(USUARIO_ERROR_2,get_class($this),__FUNCTION__);
     				processFailed(EMPTY_FIELD,USUARIO_ERROR_2);
     				exit(0);
     			}
     			printSuccessLog('Ingreso Usuario : '.$user. ' Password : ' .$password ,get_class($this),__FUNCTION__);

     			try{
     				$data = Usuario::find('all',
     					array('conditions' => array('usuario = ? AND contrasena = ?',
					$user,
					$password
				 	)));
                if(count($data)==0){
                    processFailed(WRONG_CAMP,USUARIO_ERROR_3);
                    printErrorLog(USUARIO_ERROR_3,get_class($this),__FUNCTION__);
                    exit(0);
                }else{
                    //Operacion Exitosa, usuario y contraseña ACCESS GRANTED
                    processSuccess(USUARIO_SUCCES_1);
                    printSuccessLog('Acceso permitido. Usuario : ['.$user.'] Password : ['.$password . ']',get_class($this),__FUNCTION__);
                }

     			} catch (ActiveRecord\RecordNotFound $e) {
					processFailed(NO_EXIST,USUARIO_ERROR_3);
       				printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
       				exit(0);
				}

			} catch (ActiveRecord\RecordNotFound $e) {
				 processFailed(NO_EXIST,USUARIO_ERROR_3);
       			 printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
			}
    }

    public function createUser(){
        printSuccessLog('Ingreso al metodo.' ,get_class($this),__FUNCTION__);
        $usuario = new Usuario();
        $usuario->globalmx_rol_id_rol = getParam('rol');
        $usuario->cedula = getParam('cedula');
        $usuario->usuario = getParam('user');
        $usuario->contrasena = getParam('pass');

        if (is_null($usuario->globalmx_rol_id_rol) || is_null($usuario->cedula) 
         || is_null($usuario->usuario) || is_null($usuario->contrasena)) {
            printErrorLog(USUARIO_ERROR_4,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,USUARIO_ERROR_4);
            exit(0);
        }
        printSuccessLog('Campos : ROL['.$usuario->globalmx_rol_id_rol.'] CEDULA['.$usuario->cedula.'] USER :['.$usuario->usuario.']' ,get_class($this),__FUNCTION__);
                $data = Usuario::find('first',
                        array('conditions' => array('usuario like ?', $usuario->usuario
                    )));
                if(count($data)==0){
                    printSuccessLog('Disponible. Usuario : ['.$usuario->usuario.']',get_class($this),__FUNCTION__);
                    try{
                            Rol::find($usuario->globalmx_rol_id_rol);
                            $ret = $usuario->save();
                            if ($ret == false)
                            {
                                $cedulaError = $usuario->errors->on('cedula');
                                $rolError = $usuario->errors->on('globalmx_rol_id_rol');
                                $usuarioError = $usuario->errors->on('usuario');
                                $contrasenaError = $usuario->errors->on('contrasena');
                                if(is_null($cedulaError)){
                                        if(is_null($rolError)){
                                            if(is_null($usuarioError)){
                                                if(is_null($contrasenaError)){
                                                     processFailed(ADV,TOTAL_FAILED);
                                                     printErrorLog(TOTAL_FAILED,get_class($this),__FUNCTION__);
                                                }else{
                                                     processFailed(ADV,$contrasenaError);
                                                     printErrorLog($contrasenaError,get_class($this),__FUNCTION__);
                                                }
                                            }else{
                                                processFailed(ADV,$usuarioError);
                                                printErrorLog($usuarioError,get_class($this),__FUNCTION__);
                                            }
                                        }else{
                                            processFailed(ADV,$rolError);
                                            printErrorLog($rolError,get_class($this),__FUNCTION__);
                                        }
                                }else{
                                    processFailed(ADV,$cedulaError);
                                    printErrorLog($cedulaError,get_class($this),__FUNCTION__);
                                }
                            }else{
                                processSuccess(USUARIO_SUCCES_2);
                                printSuccessLog('Usuario Creado : ['.$usuario->usuario.']',get_class($this),__FUNCTION__);
                            }
                       } catch (ActiveRecord\RecordNotFound $e) {
                            processFailed(NO_EXIST,ROL_ERROR_1);
                            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
                            exit(0);
                       }
                }else{
                    processFailed(EXIST_DATA,USUARIO_ERROR_5);
                    printErrorLog(USUARIO_ERROR_5,get_class($this),__FUNCTION__);
                    exit(0);
                }
    }
    public function deleteUser(){
        printSuccessLog('Ingreso al metodo.' ,get_class($this),__FUNCTION__);
            $id = getParam('id');
            if (is_null($id)) {
                printErrorLog(USUARIO_ERROR_6,get_class($this),__FUNCTION__);
                processFailed(EMPTY_FIELD,USUARIO_ERROR_6);
                exit(0);
            }
         try{ 
             $post = Usuario::find_by_id_usuario($id);
             if(is_null($post->id_usuario)){
                 processFailed(NO_EXIST,USUARIO_ERROR_7);
                 printErrorLog(USUARIO_ERROR_7,get_class($this),__FUNCTION__);
                 exit(0);
             }
             try{
                     if($post->delete() == 1){
                        processSuccess(USUARIO_SUCCES_3);
                        printSuccessLog(USUARIO_SUCCES_3,get_class($this),__FUNCTION__);
                     }
                     else{
                         processFailed(ERR,USUARIO_ERROR_8);
                         printErrorLog(USUARIO_ERROR_8,get_class($this),__FUNCTION__);
                         exit(0);
                     }
                } catch (ActiveRecord\DatabaseException $e){
                         processFailed(ERR,USUARIO_ERROR_8);
                         printErrorLog(USUARIO_ERROR_8,get_class($this),__FUNCTION__);
                         exit(0);
                } 
            } catch (ActiveRecord\RecordNotFound $e) {
                 processFailed(NO_EXIST,USUARIO_ERROR_7);
                 printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
                 exit(0);
            }
    }

    public function listUser(){
            try{
            printSuccessLog('Entro metodo....',get_class($this),__FUNCTION__);
            $data = Usuario::find('all');
            printSuccessLog('Encontro usuarios.',get_class($this),__FUNCTION__);
            $concact = null;
                foreach ($data as $key) {
                    $json = $key->to_json();
                    $concac.=$json.',';
                }
            $concac = substr($concac, 0, strlen($concac) - 1);
            processSuccess($concac);
            printSuccessLog('Imprime Usuarios.',get_class($this),__FUNCTION__);
            } catch (ActiveRecord\RecordNotFound $e) {
                processFailed(NO_EXIST,USUARIO_ERROR_7);
                printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            }
    }

    public function listUserById(){
            try{
            printSuccessLog('Entro metodo....',get_class($this),__FUNCTION__);
            $id = getParam('id');
            if (is_null($id)) {
                printErrorLog(USUARIO_ERROR_6,get_class($this),__FUNCTION__);
                processFailed(EMPTY_FIELD,USUARIO_ERROR_6);
                exit(0);
            }
            $data = Usuario::find($id);
            printSuccessLog('Encontro usuarios.',get_class($this),__FUNCTION__);
            processSuccess($data->to_json());
            printSuccessLog('Imprime Usuarios.',get_class($this),__FUNCTION__);
            } catch (ActiveRecord\RecordNotFound $e) {
                processFailed(NO_EXIST,USUARIO_ERROR_7);
                printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            }
    }

    public function updateUser(){
        printSuccessLog('Ingreso al metodo.' ,get_class($this),__FUNCTION__);
        $id = getParam('id');
            if (is_null($id)) {
                printErrorLog(USUARIO_ERROR_6,get_class($this),__FUNCTION__);
                processFailed(EMPTY_FIELD,USUARIO_ERROR_6);
                exit(0);
            }
        $usuario = Usuario::find($id);
        $usuario->globalmx_rol_id_rol = getParam('rol');
        $usuario->cedula = getParam('cedula');
        $usuario->usuario = getParam('user');
        $usuario->contrasena = getParam('pass');

        if (is_null($usuario->globalmx_rol_id_rol) || is_null($usuario->cedula) 
         || is_null($usuario->usuario) || is_null($usuario->contrasena)) {
            printErrorLog(USUARIO_ERROR_4,get_class($this),__FUNCTION__);
            processFailed(EMPTY_FIELD,USUARIO_ERROR_4);
            exit(0);
        }
        printSuccessLog('Campos : ROL['.$usuario->globalmx_rol_id_rol.'] CEDULA['.$usuario->cedula.'] USER :['.$usuario->usuario.']' ,get_class($this),__FUNCTION__);
                $data = Usuario::find('first',
                        array('conditions' => array('usuario like ? AND id_usuario NOT IN(?)', $usuario->usuario , $id )));
                if(count($data)==0){
                    printSuccessLog('Disponible. Usuario : ['.$usuario->usuario.']',get_class($this),__FUNCTION__);
                    try{
                            Rol::find($usuario->globalmx_rol_id_rol);
                            $ret = $usuario->save();
                            if ($ret == false)
                            {
                                $cedulaError = $usuario->errors->on('cedula');
                                $rolError = $usuario->errors->on('globalmx_rol_id_rol');
                                $usuarioError = $usuario->errors->on('usuario');
                                $contrasenaError = $usuario->errors->on('contrasena');
                                if(is_null($cedulaError)){
                                        if(is_null($rolError)){
                                            if(is_null($usuarioError)){
                                                if(is_null($contrasenaError)){
                                                     processFailed(ADV,TOTAL_FAILED);
                                                     printErrorLog(TOTAL_FAILED,get_class($this),__FUNCTION__);
                                                }else{
                                                     processFailed(ADV,$contrasenaError);
                                                     printErrorLog($contrasenaError,get_class($this),__FUNCTION__);
                                                }
                                            }else{
                                                processFailed(ADV,$usuarioError);
                                                printErrorLog($usuarioError,get_class($this),__FUNCTION__);
                                            }
                                        }else{
                                            processFailed(ADV,$rolError);
                                            printErrorLog($rolError,get_class($this),__FUNCTION__);
                                        }
                                }else{
                                    processFailed(ADV,$cedulaError);
                                    printErrorLog($cedulaError,get_class($this),__FUNCTION__);
                                }
                            }else{
                                processSuccess(USUARIO_SUCCES_4);
                                printSuccessLog('Usuario Modificado : ['.$usuario->usuario.']',get_class($this),__FUNCTION__);
                            }
                       } catch (ActiveRecord\RecordNotFound $e) {
                            processFailed(NO_EXIST,ROL_ERROR_1);
                            printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
                            exit(0);
                       }
                }else{
                    processFailed(EXIST_DATA,USUARIO_ERROR_5);
                    printErrorLog(USUARIO_ERROR_5,get_class($this),__FUNCTION__);
                    exit(0);
                }
    }

        public function getId(){
        printSuccessLog('Ingreso al metodo.' ,get_class($this),__FUNCTION__);
        try{
            $user = getParam('user');
            $password = getParam('password');

                if (is_null($user)) {
                    printErrorLog(USUARIO_ERROR_1,get_class($this),__FUNCTION__);
                    processFailed(EMPTY_FIELD,USUARIO_ERROR_1);
                    exit(0);
                }

                if (is_null($password)) {
                    printErrorLog(USUARIO_ERROR_2,get_class($this),__FUNCTION__);
                    processFailed(EMPTY_FIELD,USUARIO_ERROR_2);
                    exit(0);
                }
                printSuccessLog('Ingreso Usuario : '.$user. ' Password : ' .$password ,get_class($this),__FUNCTION__);

                try{
                    $data = Usuario::find('id_usuario',
                        array('conditions' => array('usuario = ? AND contrasena = ?',
                    $user,
                    $password
                    )));
                if(count($data)==0){
                    processFailed(WRONG_CAMP,USUARIO_ERROR_3);
                    printErrorLog(USUARIO_ERROR_3,get_class($this),__FUNCTION__);
                    exit(0);
                }else{
                    processSuccess($data->id_usuario);
                }

                } catch (ActiveRecord\RecordNotFound $e) {
                    processFailed(NO_EXIST,USUARIO_ERROR_3);
                    printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
                    exit(0);
                }

            } catch (ActiveRecord\RecordNotFound $e) {
                 processFailed(NO_EXIST,USUARIO_ERROR_3);
                 printErrorLog($e->getMessage(),get_class($this),__FUNCTION__);
            }
    }
}
?>