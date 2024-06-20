<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>



<article>


  <div class="card bg-light mt-5 w-75 card-center" style="margin-left:22%;">

        <div class="card-header">
            <div><h6>Curso: <?php echo $datos['lectivo'][0]->nombre?></h6></div>
            <div><h6>Horas totales: <?php echo $datos['datos_modulo'][0]->horas_totales?></h6></div>
            <div class="mt-4 mb-2">
                <?php foreach($datos['datos_modulo'] as $dat) { ?>
                    <h6>Profesor: <?php echo $dat->nombre_completo?></h6>
                <?php  }?>
            </div>

        </div>

  
    <div class="row">
   
        <form method="post" class="card-body" action="<?php echo RUTA_URL?>/profeSegui/horas_dia/<?php echo $datos['datos_modulo'][0]->id_modulo?>">
        <div class="row mt-4">

            <div class="col-2">
            <div class="input-group">
                <label class="input-group-text" for="Lunes">Lunes</label>
                <input type="text" name="horas[]"
                value="<?php foreach($datos['horario_modulo'] as $hor){
                    if($hor->id_horario==1){
                        echo $hor->total_horas;
                    }
                } ?>" class="form-control form-control-sm">
            </div>
            </div>

            <div class="col-2">
            <div class="input-group">
                <label class="input-group-text"for="Martes">Martes</label>
                <input type="text" name="horas[]"
                    value="<?php foreach($datos['horario_modulo'] as $hor){
                    if($hor->id_horario==2){
                        echo $hor->total_horas;
                    }
                } ?>"
                class="form-control form-control-sm">
            </div>
            </div>

            <div class="col-2">
            <div class="input-group">
                <label class="input-group-text" for="Miercoles">Miercoles</label>
                <input type="text" name="horas[]"
                    value="<?php foreach($datos['horario_modulo'] as $hor){
                    if($hor->id_horario==3){
                        echo $hor->total_horas;
                    }
                } ?>"
                class="form-control form-control-sm">
            </div>
            </div>

            <div class="col-2">
            <div class="input-group">
                <label class="input-group-text" for="Jueves">Jueves</label>
                <input type="text" name="horas[]"
                    value="<?php foreach($datos['horario_modulo'] as $hor){
                        if($hor->id_horario==4){
                            echo $hor->total_horas;
                        }
                    } ?>"
                class="form-control form-control-sm">
            </div>
            </div>

            <div class="col-2">
            <div class="input-group">
                <label class="input-group-text" for="Viernes">Viernes</label>
                <input type="text" name="horas[]"
                value="<?php foreach($datos['horario_modulo'] as $hor){
                    if($hor->id_horario==5){
                        echo $hor->total_horas;
                    }
                } ?>"
                class="form-control form-control-sm">
            </div>
            </div>

           <div class="col-2">
                <input type="submit" class="btn" name="aceptar" id="confirmar" value="Confirmar">
            </div>


            </div>

            
        </form>
   


<div class="col-7">

  <table id="tabla" class="table">



<!--CABECERA TABLA-->
<thead>
    <tr>
        <th>Nº TEMA</th>
        <th>NOMBRE</th>
        <th>HRS PREVISTAS</th>
        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[10])):?>
            <th>OPCIONES</th>
        <?php endif ?>
    </tr>
</thead>

<!--BODY TABLA-->
<tbody>

    <?php
    foreach($datos['tem'] as $tema): 
        if(($tema->descripcion!="Otros") && ($tema->descripcion!="Faltas") && ($tema->descripcion!="Actividades") ){
    ?>
    <tr>

        <td><?php echo $tema->tema?></td>
        <td><?php echo $tema->descripcion?></td>
        <td><?php echo $tema->total_horas?></td>

    <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[10])):?>

        <td>


        <!-- EDITAR TEMA -->
        <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $tema->id_tema?>" >
            <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
        </a>


        <div class="modal" id="editar_<?php echo $tema->id_tema?>">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                    <p class="modal-title ms-3">Tema <?php echo $tema->tema.' - '. $tema->descripcion?></p>
                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">
                <div class="row ms-1 me-1">

                        <form action="<?php echo RUTA_URL?>/profeSegui/editar_tema/"<?php echo $tema->id_tema?> method="post">
                            <div class="row mt-3 mb-4">
                                <div class="col-8">
                                    <div class="input-group">
                                        <label for="descripcion" class="input-group-text">Nombre</label>
                                        <input type="text" class="form-control form-control-md" name="descripcion" value="<?php echo $tema->descripcion?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="horas" class="input-group-text">Hrs previstas</label>
                                        <input type="text" class="form-control form-control-md" id="horas_tema" name="horas_tema" value="<?php echo $tema->total_horas?>" required >
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <input type="hidden" name="id_modulo" value="<?php echo $datos['datos_modulo'][0]->id_modulo?>">
                                <input type="hidden" name="id_tema" value="<?php echo $tema->id_tema?>">
                                <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar">
                            </div>

                        </form>

                        </div>
                        </div>

        </div>
        </div>
        </div>



            <!-- BORRAR TEMA -->
             <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $tema->id_tema?>">
              <?php if($tema->descripcion!='Examenes'){?>
                    <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>

             <?php }
              
              ?>
              
            </a>


                <div class="modal" id="borrar_<?php echo $tema->id_tema?>">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                        <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body mt-3">
                            <p>Estas seguro de querer borrar el tema <b><?php echo $tema->tema.' - '. $tema->descripcion?></b> ? </p>
                        </div>

                        <div class="modal-footer">
                            <form action="<?php echo RUTA_URL?>/profeSegui/borrar_tema/<?php echo $tema->id_tema?>" method="post">
                                <input type="hidden" name="id_modulo" value="<?php echo $datos['datos_modulo'][0]->id_modulo?>">
                                <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                            </form>
                        </div>

                </div>
                </div>
                </div>




        </td>
        <?php endif ?>
    </tr>
    <?php } endforeach ?>
</tbody>

</table>
</div>



</div>


            <!-- MODAL AÑADIR NUEVO TEMA -->
            <div class="col text-center mt-5 mb-4">
                <a data-bs-toggle="modal" data-bs-target="#nuevo">
                    <input type="button" id="anadir" class="btn" value="Alta de temas">
                </a>
            </div>


                <!-- Ventana -->
                <div class="modal" id="nuevo">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header azul">
                            <p class="modal-title ms-3">Alta de temas</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>
                    
                        <!-- Body -->
                        <div class="modal-body info ">                         
                        <div class="row ms-1 me-1"> 

                        <form method="post" action="<?php echo RUTA_URL?>/profeSegui/nuevo_tema/<?php echo $datos['datos_modulo'][0]->id_modulo?>">


                            <div class="row" id="nuevo_tema">
                                <!-- <div class="col-2 mt-3">
                                    <div class="input-group">
                                        <label for="numero" class="input-group-text">Nº</label>
                                        <input type="text" class="form-control form-control-md" id="numero" name="numero[]" required >
                                    </div>
                                </div> -->
                                <!-- <div class="col-6 mt-3">
                                    <div class="input-group">
                                        <label for="nombre" class="input-group-text">Examenes</label>
                                        <input type="text" class="form-control form-control-md" name="nombre[]" value="Examenes" readonly>
                                    </div>
                                </div> -->
                                <div class="col-3 mt-3">

                                    <div class="input-group">
                                        <label for="horas" class="input-group-text">Horas de examenes</label>
                                        <input type="hidden" name="nombre[]" value="Examenes">
                                        <input type="hidden" name="numero[]" value="0">
                                        <input type="text" class="form-control form-control-md" id="horas" name="horas[]" value="<?php echo $datos['tem'][0]->total_horas?>" 
                                            <?php
                                                if ($datos['tem'][0]!=''){
                                                    echo "readonly";
                                                    
                                                }else{
                                                    echo "required";
                                             }
                                            ?>>
                                        <input type="hidden" name="nombre[]" value="Actividades">
                                        <input type="hidden" name="numero[]" value="9898">
                                        <input type="hidden" name="horas[]" value="0">
                                        <input type="hidden" name="nombre[]" value="Faltas">
                                        <input type="hidden" name="numero[]" value="9797">
                                        <input type="hidden" name="horas[]" value="0">
                                        <input type="hidden" name="nombre[]" value="Otros">
                                        <input type="hidden" name="numero[]" value="9696">
                                        <input type="hidden" name="horas[]" value="0">
                                    </div>
                                </div>
                            </div>

                            <div><input type="button" id="anadir" class="btn mt-4" value="Añadir tema" onclick="nuevo_tema();"></div>

                            <div class=" d-flex justify-content-end">
                                <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Confirmar">        
                            </div> 
                        </form>


                        </div>
                        </div>

                </div>
                </div>
                </div>



</div>

</article>
<script>

function nuevo_tema(){


  
    var fila=document.createElement("div");
    fila.setAttribute("class","row mt-4");


    // COLUMNA NUMERO TEMA
     var col_num = document.createElement("div")
     col_num.setAttribute("class","col-2");

     var input_g_num = document.createElement("div")
     input_g_num.setAttribute("class","input-group");

    // label e input 
    var label_f_num = document.createElement("label");
    label_f_num.setAttribute("for","numero");
    label_f_num.setAttribute("class","input-group-text");
    var txt_numero = document.createTextNode("NºTema");
    label_f_num.appendChild(txt_numero);

    var input_f_num = document.createElement("input");
    input_f_num.setAttribute("type","text");
    input_f_num.setAttribute("class","form-control form-control-md");
    input_f_num.setAttribute("id","numero");
    input_f_num.setAttribute("name","numero[]");
    input_f_num.setAttribute("required","true");
 

    input_g_num.appendChild(label_f_num);
    input_g_num.appendChild(input_f_num);

    col_num.appendChild(input_g_num);
    fila.appendChild(col_num)

    document.getElementById("nuevo_tema").appendChild(fila);



    // COLUMNA NOMBRE
     var col_nom = document.createElement("div")
     col_nom.setAttribute("class","col-7");

     var input_g_nom = document.createElement("div")
     input_g_nom.setAttribute("class","input-group");

    // label e input 
    var label_f_nom = document.createElement("label");
    label_f_nom.setAttribute("for","nombre");
    label_f_nom.setAttribute("class","input-group-text");
    var txt_nombre = document.createTextNode("Nombre");
    label_f_nom.appendChild(txt_nombre);

    var input_f_nom = document.createElement("input");
    input_f_nom.setAttribute("type","text");
    input_f_nom.setAttribute("class","form-control form-control-md");
    input_f_nom.setAttribute("id","nombre");
    input_f_nom.setAttribute("name","nombre[]");
    input_f_nom.setAttribute("required","true");

    input_g_nom.appendChild(label_f_nom);
    input_g_nom.appendChild(input_f_nom);

    col_nom.appendChild(input_g_nom);
    fila.appendChild(col_nom)

    document.getElementById("nuevo_tema").appendChild(fila);
 


// COLUMNA HORAS

    var col_fecha = document.createElement("div")
    col_fecha.setAttribute("class","col-3");

    var input_g = document.createElement("div")
    input_g.setAttribute("class","input-group");

    var label_f = document.createElement("label");
    label_f.setAttribute("for","horas");
    label_f.setAttribute("class","input-group-text");
    var txt_fecha = document.createTextNode("Hrs previstas");
    label_f.appendChild(txt_fecha);
    
    var input_f = document.createElement("input");
    input_f.setAttribute("type","text");
    input_f.setAttribute("class","form-control form-control-md");
    input_f.setAttribute("id","horas");
    input_f.setAttribute("name","horas[]");
    input_f.setAttribute("required","true");

    input_g.appendChild(label_f);
    input_g.appendChild(input_f);

    col_fecha.appendChild(input_g);
    fila.appendChild(col_fecha)


    document.getElementById("nuevo_tema").appendChild(fila);


    }


</script>