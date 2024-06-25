<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-light" style="background-color: #e9e9e9">
    <div class="container-fluid">
        <a href="<?php echo RUTA_CPIFP?>/inicio" class="nav-link"> 
            <img src="<?php echo RUTA_Icon?>logo_cpifp.png" style="width:230px;" class="mt-2 mb-2"> 
        </a> 

        <ul class="navbar-nav ms-auto me-4 mb-2 mb-md-0">
            <li class="navbar-text">
                <?php echo $datos['usuarioSesion']->login ?>
            </li>
        </ul>
        <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_LOGOUT?>">
            <span>Logout</span>
            <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
        </a>
    </div>
</nav>  
               



<table id="tabla" class="table w-50">

<!--CABECERA TABLA-->
<thead>
    <tr>
        <th>NOMBRE</th>
        <th>FECHA INICIO</th>
        <th>FECHA FIN</th>
        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[50])):?>
            <th>OPCIONES</th>
        <?php endif ?>
    </tr>
</thead>

<!--BODY TABLA-->
<tbody>

    <?php
    foreach($datos['curso'] as $curso): ?>
    <tr>

        <td><?php echo $curso->nombre?></td>
        <td><?php echo $curso->fecha_ini?></td>
        <td><?php echo $curso->fecha_fin?></td>

    <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[50])):?>
            
        <td>


              
        <!-- EDITAR CURSO -->
        <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $curso->id_lectivo?>" >
            <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
        </a>


        <div class="modal" id="editar_<?php echo $curso->id_lectivo?>">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Edicion</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/direccion/editar_curso/<?php echo $curso->id_lectivo?>" method="post">

                            <div class="row mt-4 mb-4">
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $curso->nombre?>" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="fecha_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" value="<?php echo $curso->fecha_ini?>" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="fecha_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin"value="<?php echo $curso->fecha_fin?>"  required >
                                    </div>
                                </div>
                            </div>  

                            <div class="row mb-2">
                                <div class="col-4">
                                    <input type="hidden" name="id_primera" value="<?php echo $datos['evaluacion'][0]->id_eva?>" >
                                    <input type="text" class="form-control form-control-md" name="primera" value="<?php echo $datos['evaluacion'][0]->eva?>" readonly>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="primera_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="primera_ini" value="<?php echo $datos['evaluacion'][0]->fecha_ini?>" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="primera_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="primera_fin" value="<?php echo $datos['evaluacion'][0]->fecha_fin?>"required >
                                    </div>
                                </div>  
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <input type="hidden" name="id_segunda" value="<?php echo $datos['evaluacion'][1]->id_eva?>" >
                                    <input type="text" class="form-control form-control-md" name="segunda" value="<?php echo $datos['evaluacion'][1]->eva?>" readonly>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="segunda_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="segunda_ini" value="<?php echo $datos['evaluacion'][1]->fecha_ini?>" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="segunda_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="segunda_fin" value="<?php echo $datos['evaluacion'][1]->fecha_fin?>" required >
                                    </div>
                                </div>  
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <input type="hidden" name="id_final" value="<?php echo $datos['evaluacion'][2]->id_eva?>" >
                                    <input type="text" class="form-control form-control-md" name="final" value="<?php echo $datos['evaluacion'][2]->eva?>" readonly>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="final_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="final_ini" value="<?php echo $datos['evaluacion'][2]->fecha_ini?>" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="final_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="final_fin" value="<?php echo $datos['evaluacion'][2]->fecha_fin?>" required >
                                    </div>
                                </div>  
                            </div>

                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                               </div> 

                        </form>

                        </div>
                        </div>

        </div>
        </div>
        </div>


            <!-- MODAL AÑADIR FESTIVO -->
            <a data-bs-toggle="modal" data-bs-target="#festivo_<?php echo $curso->id_lectivo?>" >
                <img class="icono" src="<?php echo RUTA_Icon?>calendar3.svg"></img>
            </a>

                <!-- Ventana -->
                <div class="modal" id="festivo_<?php echo $curso->id_lectivo?>">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header azul">
                            <p class="modal-title ms-3">Añadir festivos</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>
                    
                        <!-- Body -->
                        <div class="modal-body info ">                         
                        <div class="row ms-1 me-1"> 

                            <table>

                                <thead>
                                    <tr> 
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php foreach($datos['festivos'] as $fest):?>

                                    <?php if($fest->id_lectivo==$curso->id_lectivo): ?>
                                        <tr>      
                                        <td><?php echo $fest->nombre?></td>
                                        <td><?php echo $fest->fecha?></td>

                                        <td>
                                            <form action="<?php echo RUTA_URL?>/direccion/borrar_festivo/<?php echo $fest->id_festivo?>" method="post">
                                                <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                            </form>
                                        </td>

                                    </tr> 

                                    <?php endif ?>                                   
                                    <?php endforeach ?>
                                </tbody>
                                
              
                            </table>

                        <form method="post" action="<?php echo RUTA_URL?>/direccion/nuevo_festivo/<?php echo $curso->id_lectivo?>">


                            <div class="row " id="festivo<?php echo $curso->id_lectivo?>">
                            </div> 

                            <div><input type="button" id="anadir" class="btn mt-4" value="Añadir festivo" onclick="fest(<?php echo $curso->id_lectivo?>);"></div>
                            <div class=" d-flex justify-content-end">
                                <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Confirmar">        
                            </div> 
                        </form>


                        </div>
                        </div>

                </div>
                </div>
                </div>




            <!-- MODAL BORRAR -->
             <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $curso->id_lectivo?>">
              <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
            </a>

       
                <div class="modal" id="borrar_<?php echo $curso->id_lectivo?>">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                        <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body mt-3"> 
                            <p>Estas seguro de querer borrar el curso <b><?php echo $curso->nombre?></b> ? </p>
                        </div>

                        <div class="modal-footer">
                            <form action="<?php echo RUTA_URL?>/direccion/borrar/<?php echo $curso->id_lectivo?>" method="post">
                                <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                            </form>
                        </div>

                </div>
                </div>
                </div> 

                


        </td>
        <?php endif ?>
    </tr>
    <?php endforeach ?>
</tbody>

</table>



       <!-- AÑADIR NUEVO CURSO -->
       <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nueva Curso">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Alta de cursos</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/direccion/nuevo_curso" method="post">

                            <div class="row mb-5">
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="fecha_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="fecha_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" required >
                                    </div>
                                </div>  
                            </div>

                            <div class="row mb-2 d-flex">
                                <div class="col-4">
                                    <input type="text" class="form-control form-control-md" name="primera" value="1ª evaluacion" readonly>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="primera_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="primera_ini" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="primera_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="primera_fin" required >
                                    </div>
                                </div>  
                            </div>


                            <div class="row mb-2 ">
                                <div class="col-4">
                                    <input type="text" class="form-control form-control-md" name="segunda" value="2ª evaluacion" readonly>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="segunda_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="segunda_ini" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="segunda_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="segunda_fin" required >
                                    </div>
                                </div>  
                            </div>
                            <div class="row mb-2">
                                <div class="col-4">
                                    <input type="text" class="form-control form-control-md" name="final" value="Final" readonly>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="final_ini" class="input-group-text">Fecha inicio <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="final_ini" required >
                                    </div>
                                </div>  
                                <div class="col-4">
                                    <div class="input-group">
                                        <label for="final_fin" class="input-group-text">Fecha fin <sup>*</sup></label>
                                        <input type="date" class="form-control form-control-md" name="final_fin" required >
                                    </div>
                                </div>  
                            </div>


                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                               </div> 

                        </form>

                        </div>
                        </div>

        </div>
        </div>
        </div>




<script>
    
   function fest(id) {
    var festivo="festivo"+id;
    //console.log(festivo);


//     <div class="row mt-4">
//         <div class="col-6">
//             <div class="input-group">
//                 <label for="festivo" class="input-group-text">Nombre <sup>*</sup></label>
//                 <input type="text" class="form-control form-control-md" id="festivo" name="festivo" required >
//             </div>
//         </div>
//         <div class="col-6">
//             <div class="input-group">
//                 <label for="fecha" class="input-group-text">Fecha <sup>*</sup></label>
//                 <input type="date" class="form-control form-control-md" id="fecha" name="fecha" required >
//             </div>
//         </div>
// </div> 


// COLUMNA NOMBRE
    var fila=document.createElement("div");
    fila.setAttribute("class","row mt-4");


    //columnas
    var col_nom = document.createElement("div")
    col_nom.setAttribute("class","col-6");

    var input_g_nom = document.createElement("div")
    input_g_nom.setAttribute("class","input-group");

    // label e input 
    var label_f_nom = document.createElement("label");
    label_f_nom.setAttribute("for","festivo");
    label_f_nom.setAttribute("class","input-group-text");
    var txt_nombre = document.createTextNode("Nombre*");
    label_f_nom.appendChild(txt_nombre);

    var input_f_nom = document.createElement("input");
    input_f_nom.setAttribute("type","text");
    input_f_nom.setAttribute("class","form-control form-control-md");
    input_f_nom.setAttribute("id","festivo");
    input_f_nom.setAttribute("name","festivo[]");

    input_g_nom.appendChild(label_f_nom);
    input_g_nom.appendChild(input_f_nom);

    col_nom.appendChild(input_g_nom);
    fila.appendChild(col_nom)

    document.getElementById(festivo).appendChild(fila);
 


// COLUMNA FECHA


    var col_fecha = document.createElement("div")
    col_fecha.setAttribute("class","col-6");

    var input_g = document.createElement("div")
    input_g.setAttribute("class","input-group");

    var label_f = document.createElement("label");
    label_f.setAttribute("for","fecha");
    label_f.setAttribute("class","input-group-text");
    var txt_fecha = document.createTextNode("Fecha*");
    label_f.appendChild(txt_fecha);
    
    var input_f = document.createElement("input");
    input_f.setAttribute("type","date");
    input_f.setAttribute("class","form-control form-control-md");
    input_f.setAttribute("id","fecha");
    input_f.setAttribute("name","fecha[]");

    input_g.appendChild(label_f);
    input_g.appendChild(input_f);

    col_fecha.appendChild(input_g);
    fila.appendChild(col_fecha)


    document.getElementById(festivo).appendChild(fila);





    }


</script> 
</body>
</html>




