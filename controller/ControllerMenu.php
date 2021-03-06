<?php
class ControllerMenu {
    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
    }

    public function getDetalleMenu($paramUser) {  
        $sql2 =  'SELECT r.forumtitle, p.forumtitle, p.id_programa, p.parentid, p.leaf,c.forumtitle carpeta
                        FROM globalmx_reporte r, 
                     globalmx_programas p, 
                     globalmx_carpeta c,
                     globalmx_rolesprogramas rolpro,
                     globalmx_rol roles,    
                     globalmx_usuario user
                WHERE r.id = p.id
                and c.id_carpeta = r.id_carpeta
                and rolpro.id_programa = p.id_programa
                and roles.id_rol = rolpro.id_rol
                and user.globalmx_rol_id_rol = roles.id_rol
                and user.usuario ='."'".$paramUser."'";
                
        $result = ($this->conexion->getTreeMenu($sql2));
        $resulMAS = '{ "children":[' . $result . ']}';
        $almacenarMenu = array();
        $contadorMenus = 0;
        $json;
        foreach (json_decode($resulMAS) as $key) {

            foreach ($key as $value) {

                $json = json_encode($value);
                foreach ($value as $valor => $v) {
                    $almacenarMenu[$contadorMenus++] = json_encode($v);
                }
            }
        }


        $nuevo_string = substr($json, 1);
        $nuevo_string = substr($nuevo_string, 0, -1);

        $resultado = str_replace("],", "],|", $nuevo_string);

        $resultado2 = explode(',|', $resultado);


        $arrayTree = array();
        $countTree = 0;
        for ($i = 0; $i < count($resultado2); $i++) {

            $nuevo_stringReem = substr($resultado2[$i], strpos($resultado2[$i], ':', 0));
            $arrayTree[$countTree++] = "\"children\"" . $nuevo_stringReem;
        }


        $arrayConMenuTree = array();
        $contadorConMenuTree = 0;
        for ($i = 0; $i < count($arrayTree); $i++) {

            $arrayConMenuTree[$contadorConMenuTree++] = '{
                        "forumtitle": "' . json_decode($arse = '{' . $arrayTree[$i] . '}')->children[0]->carpeta . '",
                        ' . ($arrayTree[$i]) . '
                         },';
        }
        return $arrayConMenuTree;
    }

    public function getMenu() {//MIRE EL METODO
        $paramUser =  getParam('user');
        echo '{ "children":[';
			for($i=0; $i<count($this->getDetalleMenu($paramUser)); $i++){
                     echo  '' . $this->getDetalleMenu($paramUser)[$i]. '';
                     
			}                
                   
                   echo ']}';
     
    }
}
?>

