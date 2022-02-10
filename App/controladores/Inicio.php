<?php

class Inicio extends Controlador
{
    public function __construct()
    {
        $this->loginModelo = $this->modelo('LoginModelo');
    }

    

    public function index($error = '')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->datos['email'] = trim($_POST['email']);
            $this->datos['passw'] = trim($_POST['passw']);
            $usuarioSesion = $this->loginModelo->loginEmail($this->datos['email'], $this->datos['passw']);
            if (isset($usuarioSesion) && !empty($usuarioSesion)) {       // si tiene datos el objeto devuelto entramos
                Sesion::crearSesion($usuarioSesion);
                $this->loginModelo->registroSesion($usuarioSesion->id_usuario);               // registro el login en DDBB
                redireccionar('/');
            } else {
                redireccionar('/login/index/error_1');
            }
        } else {
            if (Sesion::sesionCreada($this->datos)) {    // si ya estamos logueados redirecciona a la raiz
                if ($this->datos['usuarioSesion']->id_rol == 1) {
                    redireccionar('/admin');
                } elseif ($this->datos['usuarioSesion']->id_rol == 2) {
                    redireccionar('/entrenador');
                } elseif ($this->datos['usuarioSesion']->id_rol == 3) {
                    redireccionar('/socio');
                } elseif ($this->datos['usuarioSesion']->id_rol == 4) {
                    redireccionar('/tienda');
                }
            } else {
                $this->datos['error'] = $error;

                $this->vista('login', $this->datos);
            }
        }
    }
}
