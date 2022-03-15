<?php

class Facturacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


//********** CONSULTAS GASTOS ************//

   public function obtenerGastos(){
        $this->db->query("SELECT * from GASTOS");
        return $this->db->registros();
    }

    public function gastosPersonal(){
        $this->db->query("SELECT id_gasto, fecha, concepto, importe, G_PERSONAL.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, G_PERSONAL WHERE USUARIO.id_usuario=G_PERSONAL.id_usuario;");
        return $this->db->registros();
    }

    public function gastosOtrosUsuario(){
        $this->db->query("SELECT id_gastos, fecha, concepto, importe, G_OTROS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, G_OTROS WHERE USUARIO.id_usuario=G_OTROS.id_usuario;");
        return $this->db->registros();
    }

    public function gastosOtrosEntidad(){
        $this->db->query("SELECT id_gastos, fecha, concepto, importe, G_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, G_OTROS WHERE OTRAS_ENTIDADES.id_entidad=G_OTROS.id_usuario;");
        return $this->db->registros();
    }



//********** CONSULTAS INGRESOS ************//

    public function obtenerIngresos(){
        $this->db->query("SELECT * from INGRESOS");
        return $this->db->registros();
    }

    public function ingresosCuotas(){
        $this->db->query("SELECT id_ingreso_cuota, fecha, concepto, importe, I_CUOTAS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, I_CUOTAS WHERE USUARIO.id_usuario=I_CUOTAS.id_usuario;");
        return $this->db->registros();
    }
   
    public function ingresosActividadesSocios(){
        $this->db->query("SELECT id_ingreso_actividades,I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_usuario, I_ACTIVIDADES.id_evento,fecha,concepto, importe,
        USUARIO.nombre,USUARIO.apellidos, EVENTO.nombre as nom_evento from USUARIO,I_ACTIVIDADES,EVENTO 
        where USUARIO.id_usuario=I_ACTIVIDADES.id_usuario and EVENTO.id_evento=I_ACTIVIDADES.id_evento;");
        return $this->db->registros();
    }

    public function ingresosActividadesExternos(){
        $this->db->query("SELECT id_ingreso_actividades, I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_evento,fecha,concepto, importe,
        EXTERNO.nombre,EXTERNO.apellidos, EVENTO.nombre as nom_evento from EXTERNO,I_ACTIVIDADES,EVENTO
        where EXTERNO.id_externo=I_ACTIVIDADES.id_externo and EVENTO.id_evento=I_ACTIVIDADES.id_evento ;");
        return $this->db->registros();
    }

    public function ingresosOtros(){
        $this->db->query("SELECT id_ingreso_otros, fecha, concepto, importe,I_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, I_OTROS where OTRAS_ENTIDADES.id_entidad=I_OTROS.id_entidad;");
        return $this->db->registros();
    }


    public function agregarIngreso($ingreso){
        //var_dump($ingreso); 
        //echo $ingreso['tipo'];

        if($ingreso['tipo']=="cuotas"){
            $this->db->query("INSERT INTO I_CUOTAS (fecha, concepto, importe,id_usuario) 
            VALUES (:fecha,:concepto,:importe,:id_usuario)");
            $this->db->bind(':fecha',$ingreso['fecha']);
            $this->db->bind(':concepto', $ingreso['concepto']);
            $this->db->bind(':importe',$ingreso['importe']);
            $this->db->bind(':id_usuario',$ingreso['id_participante']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }if($ingreso['tipo']=="otros"){
            $this->db->query("INSERT INTO I_OTROS (fecha, concepto, importe,id_entidad) 
            VALUES (:fecha,:concepto,:importe,:id_entidad)");
            $this->db->bind(':fecha',$ingreso['fecha']);
            $this->db->bind(':concepto', $ingreso['concepto']);
            $this->db->bind(':importe',$ingreso['importe']);
            $this->db->bind(':id_entidad',$ingreso['id_participante']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

    }

    public function obtenerUsuarios(){
        $this->db->query("SELECT * from USUARIO where id_rol=1 or id_rol=2 or id_rol=3");
        return $this->db->registros();
    }

    public function obtenerEntidades(){
        $this->db->query("SELECT * from OTRAS_ENTIDADES");
        return $this->db->registros();
    }

    public function obtenerParticipante(){
        $this->db->query("SELECT * from PARTICIPANTE");
        return $this->db->registros();
    }

    public function obtenerEventos(){
        $this->db->query("SELECT * from EVENTO");
        return $this->db->registros();
    }






    public function borrarIngresoCuotas($id){
        $this->db->query("DELETE FROM I_CUOTAS WHERE id_ingreso_cuota =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarIngresoActividades($id){
        $this->db->query("DELETE FROM I_ACTIVIDADES WHERE id_ingreso_actividades =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarIngresoOtros($id){
        $this->db->query("DELETE FROM I_OTROS WHERE id_ingreso_otros =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


   

  

    




  

}