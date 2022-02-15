<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-socio.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    


    <title>MODIFICAR DATOS</title>
</head>
<body style="background-color: #F5F5F5;">

    <div class="container-fluid min-vh-100" style="border: solid; height: 100%;">

        <header class="p-5 row text-center">
            <div class="col-2"></div>
            <div class="col-8"><a href="<?php echo RUTA_URL ?>/socio"><img src="<?php echo RUTA_Foto?>corredor.png" width="150"><img src="<?php echo RUTA_Foto?>letras.png" width="200" ></a></div>
            <div class="col-2 text-center"><a href="<?php echo RUTA_URL ?>/login/logout"><img src="<?php echo RUTA_Icon?>salirUsu.svg" width="50" height="50"></a><br><?php echo $datos['usuarioSesion']->nombre ?></div>
            <div class="col-12"><h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #2B2B2B; font: bold; letter-spacing: 5px;">MODIFICAR DATOS</h1></div>
        </header>
        <div class="row">
            <div class="col-4 text-center">
                <div class="row" style="height: 100%;">
                    <div class="col-12"><img src="<?php echo RUTA_Icon?>usuario.svg" width="350" height="450" style="border: solid; color: #023EF9;"></div>
                    <div class="col-12"><label for="editarFoto" class="editarFoto">EDITAR FOTO</label><label class="editarFoto" style="margin-left: 5px;">GUARDAR</label><br><input type="file" style="visibility:hidden;" id="editarFoto" name="editarFoto"> </div>
                </div> 
            
            </div>
            <div class="col-4">
                <div class="row" style="padding-left: 5cm; font-family: 'Inter', sans-serif;">
                    <div class="datos col-12" >DNI</div>
                    <div class="datos col-12" >NOMBRE</div>
                    <div class="datos col-12" >APELLIDOS</div>   
                    <div class="datos col-12" >FECHA NACIMIENTO</div> 
                    <div class="datos col-12" >TELÉFONO</div>
                    <div class="datos col-12" >CORREO</div>
                    <div class="datos col-12" >CCC</div>
                    <div class="datos col-12" >CONTRASEÑA</div>
                    <div class="datos col-12" >TALLA CAMISETA</div>
                    <div class="datos col-12"><input type="button" id="guardar" name="guardar" value="GUARDAR"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="row" style="height: 100%; font-family: 'Inter', sans-serif;">
                    <form method="post">
                        <?php foreach ($datos['usuarios'] as $datosUser) : ?>
                        
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->dni=="") {echo 'DNI';} else {echo $datosUser->dni;}?>" name="dni"></div>
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->nombre=="") {echo 'NOMBRE';} else {echo $datosUser->nombre;}?>" name="nombre"></div>            
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->apellidos=="") {echo 'APELLIDOS';} else {echo $datosUser->apellidos;}?>" name="apellidos"></div>      
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->fecha_nacimiento=="") {echo 'FECHA NACIMIENTO';} else {echo $datosUser->fecha_nacimiento;}?>" name="fechaNac"></div>                    
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->telefono=="") {echo 'TELEFONO';} else {echo $datosUser->telefono;}?>" name="telefono"></div>          
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->email=="") {echo 'CORREO';} else {echo $datosUser->email;}?>" name="correo"></div>         
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->CCC=="") {echo 'CCC';} else {echo $datosUser->CCC;}?>" name="ccc"></div>
                        <div class="datos col-12" > <input type="password" size="30" placeholder="CONTRASEÑA" name="passw"></div>
                        <div class="datos col-12" > <input type="text" size="30" placeholder="<?php if ($datosUser->talla=="") {echo 'TALLA CAMISETA';} else {echo $datosUser->talla;}?>" name="talla"></div>                      
                        <div class="datos col-12" style="padding-left: 273px"><a href="<?php echo RUTA_URL ?>/socio"><input type="button" id="volver" name="volver" value="VOLVER"></a></div>
                        <?php endforeach ?>
                    </form>
                    </div>

            </div>
            
        </div>
    </div>


    
</body>
</html>

