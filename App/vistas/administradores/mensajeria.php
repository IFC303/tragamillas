<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Servicio de mensajeria</span>
                </div>
                <div class="col-2 mt-1">
                    <a href="<?php echo RUTA_URL ?>/login/logout">
                        <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
                    </a>
                </div>            
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->


    <article>
        <div class="container mt-5" style="border:solid 1px rgb(211,211,211);">

            <script>
                var menTodos =  <?php echo json_encode($datos['email_todos'])?>;
                var correos = new Array();
            </script>


                <!-- RADIOS -->
                <p class="modal-title mt-4 ms-4">Selecciona un grupo destinatario</p>
                <?php
                $destinatarios =['Administradores','Entrenadores','Socios','Participantes','Entidades'];
                foreach($destinatarios as $nombre):?>
                <input class="ms-4" type="radio" id="todos<?php echo $nombre?>" name="todos" value="todos<?php echo $nombre?>" data-bs-toggle="modal" data-bs-target="#v<?php echo $nombre?>">
                <label class="mb-4 mt-3" for="todos" id="elementSocios" style="color:#0070c6"><?php echo $nombre?></label><span style="margin-left:25px;"></span> 
   
   
                <!-- VENTANA -->
                <div class="modal" id="v<?php echo $nombre?>">
                <div class="modal-dialog modal-dialog-centered modal-dialog-md">
                <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header azul">
                            <p class="modal-title ms-3"><?php echo $nombre?></p> 
                        </div> 

                        <!-- Modal body -->
                        <div class="modal-body mt-3">
                            <input type="checkbox" id="<?php echo $nombre?>" onClick="marcar_desmarcar(this.id);"> <label for="todos">Seleccionar todos</label><hr> 
                            <div class="mt-3 mb-3">
                                <?php foreach($datos['email_todos'] as $objeto){
                                    if($objeto->tipo==$nombre){?>
                                    <input type="checkbox" class="<?php echo $objeto->tipo?>" name="<?php echo $objeto->tipo?>" id="<?php echo $objeto->tipo?>" value="<?php echo $objeto->email?>" onclick="seleccionados(this);">
                                    <?php echo $objeto->nombre."  ".$objeto->apellidos; ?> <br>
                                    <?php }
                                } ?> 
                            </div> 
                        </div>

                        <div class="d-flex me-3 justify-content-end">
                            <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar" data-bs-dismiss="modal" onclick="aceptar();"> 
                        </div> 

                </div>
                </div>
                </div>
                                 

                <?php endforeach ?>         
                   
               

                <!-- FORMULARIO -->
                 <div class="info ms-4 me-4"> 
                    <form method="post" action="<?php echo RUTA_URL?>/adminMensajeria/enviar">
                        <div class="row mt-4 mb-4">
                            <div class="input-group">
                                <label for="destinatario" class="input-group-text">Email destinatario</label>
                                <input type="text" class="form-control form-control-md" name="destinatario" id="destinatario" required>
                            </div> 
                        </div>
                        <div class="row mb-4">
                            <div class="input-group">
                                <label for="asunto" class="input-group-text">Asunto</label>
                                <input type="text" class="form-control form-control-md" name="asunto" id="asunto" required>
                            </div> 
                        </div>

                        <div class="mb-3">
                            <textarea type="text" rows="7" name="mensaje" id="mensaje" placeholder="Escribe aqui tu mensaje" class="form-control form-control-lg" required></textarea>
                        </div>

                        <div class="row"> 
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar"  value="Enviar"> 
                            </div>
                        </div>

                        <input type="hidden" name="enviarCorreos" id="enviarCorreos"  value="">
                    </form>
                </div> 

        </div>
    </article>



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>



<script>


        //FUNCION SELECCIONAR Y DESELECIONAR TODOS A LA VEZ
        function marcar_desmarcar(todos){
            casillas=document.getElementsByClassName(todos);
            todos=document.getElementById(todos);

                for(i=0;i<casillas.length;i++){
                    if(casillas[i].type == "checkbox"){
                        casillas[i].setAttribute("checked","true");
                    if((casillas[i].checked=todos.checked)){
                        correos.push(casillas[i].value);
                        } else{
                            var indice = correos.indexOf(casillas[i].value)
                            correos.splice(indice,1)
                        }
                    }
                }
                console.log(correos);
            document.getElementById('destinatario').setAttribute("value",correos);
        }


        //SELECCION UNO A UNO
        function seleccionados(seleccionado){
            seleccionado.setAttribute("checked","false");
        
            if(seleccionado.checked==true){
                correos.push(seleccionado.value);
                document.getElementById('destinatario').setAttribute("value",correos);
            }else{
                var ind=correos.indexOf(seleccionado.value)
                correos.splice(ind,1)
                document.getElementById('destinatario').setAttribute("value",correos);   
            }     
            console.log(correos)  
        }



        function aceptar(){
            document.getElementById('enviarCorreos').setAttribute("value",correos);
        }

                     
        function quitar(){
            correos.splice(0);
            document.getElementById('destinatario').setAttribute('value',"");
        }


</script>

