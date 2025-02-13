<?php
// Ruta de la aplicacion
define('RUTA_APP', dirname(dirname(__FILE__)));

// Ruta url, Ejemplo: http://localhost/daw2_mvc
//define('RUTA_URL', "https://{$_SERVER['HTTP_HOST']}/tragamillas");

// Ruta local
//define('RUTA_URL', 'https://80.28.234.191:63443/tragamillas');
//define('RUTA_URL', "https://192.168.100.153/tragamillas");
define('RUTA_URL', "http://localhost/tragamillas");

define('NOMBRE_SITIO', 'Tragamillas');

// Ruta host
define('DB_HOST', 'localhost');

// Ruta bridge
//define('DB_HOST', '172.17.0.2');

// Ruta dinámica
//define('DB_HOST', 'mysql');
define('DB_USUARIO', 'root');
define('DB_PASSWORD', 'Admin1234');
define('DB_NOMBRE', 'tragv2');
//define('DB_PASSWORD', 'Admin1234');

define('RUTA_Public', RUTA_URL . '/public');
define('RUTA_Icon', RUTA_URL . '/public/img/icons/');
define('RUTA_Foto', RUTA_URL . '/public/img/fotos/');
define('RUTA_ImgDatos', RUTA_URL . '/public/img/fotosPerfil/');
define('RUTA_Equipacion', RUTA_URL . '/public/img/fotos_equipacion/');
define('RUTA_Licencia', RUTA_URL . '/public/img/licencias/');
define('RUTA_Justificante', RUTA_URL . '/public/img/eventos/');
