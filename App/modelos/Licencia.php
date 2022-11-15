<?php

class Licencia{

    private $db;

    public function __construct(){
        $this->db = new Base; 
    }


    //*********************************** VER ****************************************/
    public function obtenerNombreSocio(){
        $this->db->query("SELECT * FROM v2usuario;");
        return $this->db->registros();
    } 

    public function obtenerLicencias(){
        $this->db->query("SELECT * FROM v2licencia;");
        return $this->db->registros();
    }


     public function obtenerSocioLicencia(){
         $this->db->query("SELECT * FROM v2licencia, v2usuario WHERE v2usuario.id_usuario = v2licencia.id_usuario ORDER BY v2usuario.id_usuario");
         return $this->db->registros();
     }


     
//*********************************** NUEVO ****************************************/

    public function agregarLicencia($licencia){

        $this->db->query("INSERT INTO v2licencia(id_usuario, imagen, num_licencia, fecha_cad, tipo, dorsal, regional_nacional) 
        VALUES (:id, :foto, :num_lic, :fecha, :tipo, :dorsal, :aut_nac);");
        
        $this->db->bind(':id', $licencia['usuario']);
        $this->db->bind(':tipo', $licencia['tipo']);
        $this->db->bind(':fecha', $licencia['fecha']);

        if ($licencia['num_lic']=="") {
            $this->db->bind(':num_lic', null);
        }else {
            $this->db->bind(':num_lic', $licencia['num_lic']);
        }
        
        if ($licencia['aut_nac']=='') {
            $this->db->bind(':aut_nac',null);  
        }else{
            $this->db->bind(':aut_nac',$licencia['aut_nac']);
        }
       
        if ($licencia['dorsal']=="") {
            $this->db->bind(':dorsal',null);    
        }else {
            $this->db->bind(':dorsal', $licencia['dorsal']);
        }
        
        if ($licencia['foto']=="") {
            $this->db->bind(':foto', null);    
        }else {
            $this->db->bind(':foto', $licencia['foto']);
        }

        $this->db->execute();
        $id_licen = $this->db->ultimoIndice();


         if($licencia['foto']!=''){
        //     //COPIO LA FOTO EN EL DIRECTORIO Y CAMBIO NOMBRE EN LA BBDD  
        //     //$directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
             $directorio="C:/xampp/htdocs/tragamillas/public/img/licencias/";   
             copy($_FILES['subirFoto']['tmp_name'], $directorio.$id_licen.'.jpg');
             chmod($directorio.$id_licen.'.jpg',0777);

             $foto=$id_licen.'.jpg';
             $this->db->query("UPDATE v2licencia SET imagen=:foto where id_licencia=:id_licen;");
             $this->db->bind(':foto', $foto);
             $this->db->bind(':id_licen', $id_licen);
             $this->db->execute();
         } ; 
            

        if($licencia['tipo']=='Escolar'){
            $this->db->query("UPDATE v2usuario SET gir=:gir WHERE id_usuario=:id_usuario;");
            $this->db->bind(':id_usuario', $licencia['usuario']);
            if ($licencia['gir']=="") {
                 $this->db->bind(':gir', NULL);
             }else {
                 $this->db->bind(':gir', $licencia['gir']);
             }
            
            if($this->db->execute()){
                 return true;
            }else{
                return false;
            }

        } else{
            return true;
        } 
    }


//*********************************** EDITAR ****************************************/

    public function editarLicencia($licencia_modificada , $id){

        $this->db->query("UPDATE v2licencia SET imagen=:imagen, num_licencia=:num, fecha_cad=:fecha, tipo=:tipo, dorsal=:dorsal, regional_nacional=:reg_na where id_licencia=:id;");
        
        $this->db->bind(':tipo',$licencia_modificada['tipo']);   
        $this->db->bind(':dorsal',$licencia_modificada['dorsal']); 

        $this->db->bind(':imagen',$licencia_modificada['foto']);

         if ($licencia_modificada['num_licencia']=="") {
             $this->db->bind(':num',null);
         }else {
             $this->db->bind(':num',$licencia_modificada['num_licencia']);
         };

         if ($licencia_modificada['fecha_cad']==""){
             $this->db->bind(':fecha',null);    
         }else {
             $this->db->bind(':fecha', $licencia_modificada['fecha_cad']);
         };

         if ($licencia_modificada['regional_nacional']=='Regional'){
             $this->db->bind(':reg_na', 'Regional');
         }elseif ($licencia_modificada['regional_nacional']=='Nacional'){
             $this->db->bind(':reg_na', 'Nacional');
         }elseif ($licencia_modificada['regional_nacional']==0) {
             $this->db->bind(':reg_na', null);
         };

        $this->db->bind(':id',$id); 

        $this->db->execute();


        if ($licencia_modificada['tipo']=="Escolar") {
            $this->db->query("UPDATE v2usuario SET gir=:gir WHERE id_usuario=:id_usuario;");
            
            $this->db->bind(':id_usuario',$licencia_modificada['id_usuario']);
            $this->db->bind(':gir',$licencia_modificada['gir']);
        
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }

    }


   //*********************************** BORRAR ****************************************/ 
    public function borrarLicencia($num_lic){      
        $this->db->query("DELETE FROM v2licencia WHERE id_licencia =:id_licencia");
        $this->db->bind(':id_licencia',$num_lic);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }








}