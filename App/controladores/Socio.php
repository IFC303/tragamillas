<?php

class Socio extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->SocioModelo = $this->modelo('SocioModelo');
      
    }

    public function index()
    {
        $this->vista('socios/inicio', $this->datos);
    }

    public function modificarDatos()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;
        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);

        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $directorio="/var/www/html/tragamillas/public/img/datosBBDD/";
           
            
            move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.$_FILES['foto']['name']);

            $editarDatos = [
                'dniEdit' => trim($_POST["dni"]),
                'nombreEdit' => trim($_POST["nombre"]),
                'apellidosEdit' => trim($_POST["apellidos"]),
                'telefonoEdit' => trim($_POST["telefono"]),
                'emailEdit' => trim($_POST["email"]),
                'cccEdit' => trim($_POST["ccc"]),
                'passwEdit' => trim($_POST["passw"]),
                'tallaEdit' => trim($_POST["talla"]),
                'fotoEdit' => $_FILES['foto']['name'],
            ];

            if ($this->SocioModelo->actualizarUsuario($editarDatos, $idUsuarioSesion, $datosUser)) {
                redireccionar('/socio/modificarDatos');

            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
            $this->datos['usuarios']=$datosUser;        

            $this->vista('socios/modificarDatos', $this->datos);
        }

        
    }

    public function verMarcas()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $marcas = $this->SocioModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;

        $this->vista('socios/verMarcas', $this->datos);
    }

    public function licencias(){

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $licencias = $this->SocioModelo->obtenerLicenciasId($idUsuarioSesion);
        $this->datos['usuarios']=$licencias;

        $this->vista('socios/licencias', $this->datos);
    }

    public function nuevaLicencia()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

     
        


        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dir="/var/www/html/tragamillas/public/img/datosBBDD/";
           
            
            move_uploaded_file($_FILES['ImagenLicencia']['tmp_name'], $dir.$_FILES['ImagenLicencia']['name']);
           
            $agreLic = [
                'numLicencia' => trim($_POST['NumLicencia']),
                'tipoLicencia' => trim($_POST['tipoLicencia']),
                'federativas' => trim($_POST['federativas']),
                'dorsal' => trim($_POST['Dorsal']),
                'fechaCaducidad' => trim($_POST['FechaCaducidad']),
                'imagenLicencia' => $_FILES['ImagenLicencia']['name'],
            ];

            if ($this->SocioModelo->agregarLicencia($agreLic, $idUsuarioSesion)) {
                redireccionar('/socio/licencias');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('socios/agregarLicencia', $this->datos);
        }
        
    }

    public function escuela()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
        $this->datos['usuarios']=$datosUser;        

        $this->vista('socios/formulario_escuela', $this->datos);
        
    }
    


}
