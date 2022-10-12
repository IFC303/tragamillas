<?php

class AdminEventos extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->eventoModelo = $this->modelo('Evento');
        $this->AdminModelo = $this->modelo('AdminModelo');
    }

  

    public function index(){
        $this->datos['evento'] = $this->eventoModelo->obtenerEventos();
        $this->vista('administradores/crudEventos/inicio',$this->datos);
    }


    
    public function nuevo_evento(){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $eventoNuevo = [
                'nombre' => trim($_POST['nombre']),
                'tipo'=>trim($_POST['tipo']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
                'precio'=>trim($_POST['precio']),
                'descripcion'=>trim($_POST['descripcion']), 
                'fecha_ini_inscrip' => trim($_POST['fecha_ini_inscrip']),
                'fecha_fin_inscrip'=> trim($_POST['fecha_fin_inscrip']),
            ];

            if($this->eventoModelo->agregarEvento($eventoNuevo)){
                redireccionar('/adminEventos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{

            $this->datos['evento'] = (object)[
                'nombre'=>'',
                'tipo'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
                'precio'=>'',
                'descripcion'=>'',
                'fecha_ini_inscrip'=>'',
                'fecha_fin_inscrip'=>'',
            ];
       
            $this->vista('administradores/crudEventos/nuevo_evento',$this->datos);
        }
    }



    public function borrar($id){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->eventoModelo->borrarEvento($id)) {
                redireccionar('/adminEventos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['evento'] = $this->eventoModelo->obtenerEventoId($id);
            $this->vista('administradores/crudEventos/inicio', $this->datos);
        }
    }



    public function editarEvento($id){

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $evento_modificado = [
                    'nombre' => trim($_POST['nombre']),
                    'tipo'=> trim($_POST['tipo']),
                    'fecha_ini' => trim($_POST['fecha_ini']),
                    'fecha_fin' => trim($_POST['fecha_fin']), 
                    'precio' => trim($_POST['precio']),
                    'descripcion'=>trim($_POST['descripcion']),
                    'fecha_ini_inscrip' => trim($_POST['fecha_ini_inscrip']),
                    'fecha_fin_inscrip' => trim($_POST['fecha_fin_inscrip']),  
                ];
   
                 if ($this->eventoModelo->editarEvento($evento_modificado,$id)) {
                     redireccionar('/adminEventos');
                 }else{
                     die('Algo ha fallado!!!');
                 }

        }else{
                $this->vista('administradores/crudEventos/inicio', $this->datos);
        }
    }



        public function participantes($id_evento){
            $this->datos['id_evento'] = $id_evento;
            $this->datos['participantesEventos'] = $this->eventoModelo->obtenerParticipantesEventos($id_evento);
            $this->vista('administradores/crudEventos/participantes', $this->datos);
        }


        public function borrar_participante($id){

            $this->datos['rolesPermitidos'] = [1];         
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($this->eventoModelo->borrar_participante($id)) {
                    $id_evento=$_POST['id_evento'];
                    redireccionar('/adminEventos');
                }else{
                    die('Algo ha fallado!!!');
                }
            }else{
                $this->datos['evento'] = $this->eventoModelo->obtenerEventoId($id);
                $this->vista('administradores/crudEventos/inicio', $this->datos);
            }
        }



        public function anotar_marca($id){

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $marca = [
                    'dorsal' => trim($_POST['dorsal']),
                    'marca'=> trim($_POST['marca']),
                ];

                if ($this->eventoModelo->anotar_marca($marca,$id)) {
                    redireccionar('/adminEventos');
                }else{
                    die('Algo ha fallado!!!');
                }
             }else{
                 $this->vista('administradores/crudEventos/participantes', $this->datos);
            }
                
        }


        public function nuevo_participante(){

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $nuevo = [
                    'id_evento' => trim($_POST['id_evento']),
                    'nombre' => trim($_POST['nombre']),
                    'apellidos'=> trim($_POST['apellidos']),
                    'fecha_naci' => trim($_POST['fecha_naci']),
                    'dni'=> trim($_POST['dni']),
                    'direccion' => trim($_POST['direccion']),
                    'telefono'=> trim($_POST['telefono']),
                    'email' => trim($_POST['email'])
                ];

                if ($this->eventoModelo->nuevo_participante($nuevo)) {
                    redireccionar('/adminEventos');
                }else{
                    die('Algo ha fallado!!!');
                }
             }else{
                 $this->vista('administradores/crudEventos/participantes', $this->datos);
            }
                
        }

        public function editar_participante($id){

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $nuevo = [
                    'nombre' => trim($_POST['nombre']),
                    'apellidos'=> trim($_POST['apellidos']),
                    'fecha_naci' => trim($_POST['fecha_naci']),
                    'dni'=> trim($_POST['dni']),
                    'direccion' => trim($_POST['direccion']),
                    'telefono'=> trim($_POST['telefono']),
                    'email' => trim($_POST['email'])
                ];

                if ($this->eventoModelo->editar_participante($nuevo,$id)) {
                    redireccionar('/adminEventos');
                }else{
                    die('Algo ha fallado!!!');
                }
             }else{
                 $this->vista('administradores/crudEventos/participantes', $this->datos);
            }
                
        }


        































}





