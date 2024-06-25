<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>


<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">


<script src="<?php echo RUTA_URL ?>/public/fullcalendar/lib/main.min.js"></script>
<script src="<?php echo RUTA_URL ?>/public/fullcalendar/lib/main.js"></script>
<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/fullcalendar/lib/main.css">
<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/fullcalendar/lib/main.min.css">
<script src="<?php echo RUTA_URL ?>/public/fullcalendar/lib/locales/es.min.js"></script>



<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/main.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5/main.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5/locales/es.min.js"></script> -->







    <script>



      document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');


        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',  // vista inicial mes entero
            locale:'es', // idioma en español
            hiddenDays: [ 0, 6 ] , //esconde dias de la semana

            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,listMonth'
            },


         /********************** MODAL AL HACER CLICK EN UN DIA ****************************/
            dateClick:function(date){
         
              var fecha_click=date.dateStr; // 2022-12-09 formato ejemplo

              // AÑADO A LA URL LA FECHA DEL DIA CLICKADO
              var URLactual = window.location.href;
              window.location.href = URLactual+'&fecha='+fecha_click;

              // VALOR INPUT HIDDEN FORMULARIO
              var input=document.getElementById("fecha");
              input.setAttribute("value",fecha_click);

              // TITULO HEADER FECHA (modal)
              // var fecha_titulo=fecha_click.split('-')
              // var dia_sem = new Date(fecha_click).getDay();
              // for (i=0;i<array_horario.length;i++){
              //   if(array_horario[i].id_horario==dia_sem){
              //     var hora=array_horario[i].total_horas
              //   }
              // }

              // fecha_titulo=fecha_titulo[2]+'-'+fecha_titulo[1]+'-'+fecha_titulo[0]+' ('+hora+' horas)'

              // var dia=document.getElementById('dia')
              // dia.setAttribute("value",fecha_click)

              // var dia_modi=document.createElement("span")
              // dia_modi.setAttribute("id","dia_modi")
              // var txt_dia=document.createTextNode(fecha_titulo)
              // dia_modi.appendChild(txt_dia)
              // dia.appendChild(dia_modi)


             // FILTRO POR FECHA
            //   var resultado_filtro = array_segui_temas.filter(filtro=>filtro.fecha==fecha_click);
            //   var tam=resultado_filtro.length

            //   if(tam>0){
            //      for(i=0;i<array_temas.length;i++){
            //        for(j=0;j<resultado_filtro.length;j++){
            //          if(array_temas[i].id_tema==resultado_filtro[j].id_tema){
            //           var tema=document.getElementById(array_temas[i].id_tema)
            //            tema.setAttribute("value",resultado_filtro[j].horas_dia)
            //          }
            //        }
            //      }

            //       // primer textarea
            //       var plan=document.getElementById("plan")
            //       plan.setAttribute("value",resultado_filtro[0].plan)
            //       if(resultado_filtro[0].plan==null){
            //         var txt_plan=document.createTextNode('')
            //       }else{
            //         var txt_plan=document.createTextNode(resultado_filtro[0].plan)
            //       }
            //       plan.appendChild(txt_plan)

            //       // segundo textarea
            //       var act=document.getElementById("act")
            //       act.setAttribute("value",resultado_filtro[0].actividad)
            //       if(resultado_filtro[0].actividad==null){
            //         var txt_act=document.createTextNode('')
            //       }else{
            //         var txt_act=document.createTextNode(resultado_filtro[0].actividad)
            //       }
            //       act.appendChild(txt_act)

            //       // tercer textarea
            //       var observaciones=document.getElementById("observaciones")
            //       observaciones.setAttribute("value",resultado_filtro[0].observaciones)
            //       if(resultado_filtro[0].observaciones==null){
            //         var txt_obser=document.createTextNode('')
            //       }else{
            //         var txt_obser=document.createTextNode(resultado_filtro[0].observaciones)
            //       }
            //       observaciones.appendChild(txt_obser)

            // }


            },



            /********************** MODAL BORRAR TEMA ****************************/

            eventClick: function(info) {

               var input=document.getElementById("borrado");
               input.setAttribute("value",info.event.id);
               modal_borrar_el = document.getElementById('borrar')
               modal_borrar = new bootstrap.Modal(modal_borrar_el)
               modal_borrar.show()
            },



            events: [
              // {
              //   title  : 'Alba, te gusta este color?',
              //   start  : '2022-11-15',
              //   end: '2022-11-15',
              //   display: 'background',
              //   textColor:'#000000',
              //   color:'#22fb64'
              // },
              // {
              //   title  : 'prefieres asi?',
              //   start  : '2022-11-16',
              //   end: '2022-11-16',
              //   allDay:false,
              //   color:'#22fb64',
              //   textColor:'#000000'
              // }
            ],

        });



        // Array con lainfo de los temas (horas totales,descripcion...)
        var array_temas=<?php echo json_encode($datos['temas']);?>;

        // Array con los dias festivos del curso
        var array_festivos=<?php echo json_encode($datos['festivos']);?>;

        //Array con el seguimiento de los temas
        var array_segui_temas=<?php echo json_encode($datos['segui_temas']);?>;

        //Array con el horario semanal
        var array_horario=<?php echo json_encode($datos['horario_semana']);?>;




        // PINTA LOS FESTIVOS EN ROJO
        // for(j=0;j<array_festivos.length;j++){
        // calendar.addEvent(
        //     {
        //       start: array_festivos[j].fecha,
        //       end: array_festivos[j].fecha,
        //       display: 'background',
        //       color:"#fd0804",
        //       selectable:false
        //     }
        // )
        // }


        for(i=0;i<array_segui_temas.length;i++){
            calendar.addEvent(
                { id: array_segui_temas[i].id_tema+'&'+array_segui_temas[i].fecha,
                  title:array_segui_temas[i].descripcion+' - '+array_segui_temas[i].horas_dia+' hrs',
                  start: array_segui_temas[i].fecha,
                  allDay:true,
                  color:'#aed6f1',
                  textColor:'#000000',
                  //editable:true
                }
            )
        }



        // PINTA LOS DIAS QUE NO TIENEN ESA ASIGNATURA
        // for (i=0;i<array_horario.length;i++){
        //   for(j=0;j<array_festivos.length;j++){
        //     var dia_sem = new Date(array_festivos[j].fecha).getDay();

        //     if(array_horario[i].total_horas==0){
        //         calendar.addEvent(
        //         {
        //           daysOfWeek: [ array_horario[i].id_horario ],
        //           display:'background',
        //           color:"#A1C7E0",
        //           selectable:false

        //         }
        //       )
        //     }
        //  }
        // }

        calendar.render();




        //PINTA DIAS NO TIENE CLASE
        var celda=document.getElementsByClassName('fc-daygrid-day');
        for(let i=0;i<celda.length;i++){
          var valor=celda[i].getAttribute('data-date')
          var dia_sem = new Date(valor).getDay();
          for(let j=0;j<array_horario.length; j++){ 
             if((dia_sem==array_horario[j].id_horario) && (array_horario[j].total_horas==0)){
               //celda[i].setAttribute('style','background-color:  #8cdaff')
               celda[i].setAttribute('style','background-color:  #a0d6ff')
           }
          }
        }


        //PINTA FESTIVOS
        var celda=document.getElementsByClassName('fc-daygrid-day');
        for(let i=0;i<celda.length;i++){
          for(let j=0;j<array_festivos.length; j++){
            if(celda[i].getAttribute('data-date')==array_festivos[j].fecha){
             celda[i].setAttribute('style','background-color: #fe857f')
            }
          }
        }


        var boton_sig=document.getElementsByClassName('fc-next-button')
        var boton_ant=document.getElementsByClassName('fc-prev-button')
        var boton_hoy=document.getElementsByClassName('fc-today-button')
        var boton_mes=document.getElementsByClassName('fc-dayGridMonth-button')
        
        boton_sig[0].setAttribute('onclick','pintar()')
        boton_ant[0].setAttribute('onclick','pintar()')
        boton_hoy[0].setAttribute('onclick','pintar()')
        boton_mes[0].setAttribute('onclick','pintar()')


      });

      function pintar(){

        // Array con los dias festivos del curso
        var array_festivos=<?php echo json_encode($datos['festivos']);?>;

        //Array con el horario semanal
        var array_horario=<?php echo json_encode($datos['horario_semana']);?>;


        //PINTA DIAS NO TIENE CLASE
        var celda=document.getElementsByClassName('fc-daygrid-day');
        for(let i=0;i<celda.length;i++){
          var valor=celda[i].getAttribute('data-date')
          var dia_sem = new Date(valor).getDay();
          for(let j=0;j<array_horario.length; j++){ 
             if((dia_sem==array_horario[j].id_horario) && (array_horario[j].total_horas==0)){
               celda[i].setAttribute('style','background-color:  #a0d6ff')
           }
          }
        }


        //PINTA FESTIVOS
        var celda=document.getElementsByClassName('fc-daygrid-day');
        for(let i=0;i<celda.length;i++){
          for(let j=0;j<array_festivos.length; j++){
            if(celda[i].getAttribute('data-date')==array_festivos[j].fecha){
              celda[i].setAttribute('style','background-color: #fe857f')
            }
          }
        }

       

      }



</script>


<style>

  .fc-header-toolbar {
    padding-top: 1em;
    padding-left: 1em;
    padding-right: 1em;
  }

  /*******************************************/

  html, body {
    margin: 0;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 750px;
    margin: auto;
  }

</style>




</head>


<body>


<article>


        <div class="mt-5" style="margin-left:20%;">
            <div id='calendar'></div>
        </div>



        <?php if (isset($_GET['fecha'])) {

        

            //COMPRUEBO SABADOS, DOMINGOS Y DIAS IMPARTE
            $array_fecha = explode('-', $_GET['fecha']);
            // $array_fecha[0] es el año; $array_fecha[1] es el dia; $array_fecha[2] es el mes;
            $dia_sem = mktime(0, 0, 0, $array_fecha[1], $array_fecha[2], $array_fecha[0]);
            
            setlocale(LC_TIME, 'es_ES.UTF-8');
            $dia_formato= strftime("%A, %d de %B de %Y", $dia_sem);
            $dia_semana = date("w-Y-m-j", $dia_sem);
            $dia_semana = explode('-', $dia_semana);


              // MODAL FIN DE SEMANA
              if (($dia_semana[0]==6 || $dia_semana[0]==0)) {?>           
                <script>
                $( document ).ready(function() {
                $('#fiesta').modal('toggle')
                  var nodo=document.getElementById("texto_modal")
                  var txt=document.createTextNode("Fin de semana")
                  nodo.appendChild(txt);
                 });

                </script>
              <?php };


              //MODAL FESTIVOS
              foreach ($datos['festivos'] as $festivos) { 
                if ( ($festivos->fecha==$_GET['fecha']) ) { ?>
                    <script>
                    $( document ).ready(function() {
                    $('#fiesta').modal('toggle')
                    var nodo=document.getElementById("texto_modal")
                    var txt=document.createTextNode("Dia festivo ")
                    nodo.appendChild(txt);
                    });
                    </script><?php
                }
              };

                    
                 //MODAL DIA LECTIVO
                 foreach($datos['horario_semana'] as $h_sem){
                  $fiesta=false;

                  foreach($datos['festivos'] as $festivos){
                    if($festivos->fecha==$_GET['fecha']){
                      $fiesta = true;}
                      }                  
                  if( ($h_sem->total_horas!=0) && ($h_sem->id_horario==$dia_semana[0]) && (!$fiesta) ){?>
                     <script>$( document ).ready(function() {
                      $('#modal').modal('toggle')});
                      </script>
                   <?php }                  
                 };  
    

                //MODAL DIAS SIN CLASE
                foreach($datos['horario_semana'] as $h_sem){
                  if( ($h_sem->total_horas==0) && ($h_sem->id_horario==$dia_semana[0])){?>
                    <script>
                    $( document ).ready(function() {
                    $('#fiesta').modal('toggle')
                    var nodo=document.getElementById("texto_modal")
                    nodo.innerHTMl=""
                    var txt=document.createTextNode("Dia sin horas lectivas para este modulo")
                    nodo.appendChild(txt);
                    });
                    </script><?php
                  }
                };

          }        
        ?>   




      <!-- MODAL SEGUIMIENTO DIA -->
      <div class="modal fade" id="modal">
      <div class="modal-dialog modal-lg modal-dialog-centered ">
      <div class="modal-content">


          <!-- HEADER -->
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-white" id="h4">
              <?php echo $dia_formato;

              foreach ($datos['horario_semana'] as $h_sem) {
                if ($dia_semana[0] == $h_sem->id_horario) {
                  echo ' (' . $h_sem->total_horas . ' horas)';
                }}?>
                <p id="dia" name="dia"></p>
            </h4>
            <button style="background-color:white" type="button" class="btn-close me-3" data-bs-dismiss="modal" onclick="limpiar_campo()"></button>
          </div>

   

          <form id="form_anadir" action="<?php echo RUTA_URL ?>/profeSegui/segui_dia" method="post" onsubmit="siguiente()"> 

          <!-- BODY -->
          <div class="modal-body">
          <div class="row">

              <div class="col-7">
                  <table id="tabla" style="margin-top:20px" class="table table-bordered w-50 text-center">
                    <thead>
                      <tr>
                        <th></th>
                        <th style="font-size:15px">Horas previstas</th>
                        <th style="font-size:15px">Horas impartidas</th>
                        <th style="font-size:15px">Horas/dia actual</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($datos['temas'] as $temas):

                       if (($temas->descripcion != "Faltas") && ($temas->descripcion != "Otros") && ($temas->descripcion != "Actividades")) { ?>
                      <tr>

                          <!-- Pinta los nombres temas y su descripcion-->
                          <td style="font-size:15px" nowrap>
                          <?php if ($temas->descripcion == 'Examenes') {
                            echo "Examenes";
                          } else {
                            echo "Tema " . $temas->tema.'<br>';
                            echo $temas->descripcion;
                          } ?>
                            <input type="hidden" name="temas[]" value="<?php echo $temas->id_tema ?>">
                          </td>


                          <!-- Pinta el total de horas asignados a cada tema-->
                          <td style="font-size:15px"><?php echo $temas->total_horas . ' hrs' ?></td>


                          <!-- Pinta el total de horas que llevan impartidas en cada tema-->
                          <td style="font-size:15px">
                            <?php foreach($datos['horas_impartidas'] as $horas_imp){
                              if($horas_imp->id_tema==$temas->id_tema){
                              echo $horas_imp->horas_tema.' hrs';
                              }
                              }?>
                          </td>


                          <!-- Pinta las horas que da ese dia a cada tema-->
                          <td style="font-size:15px">
                            <input type="text" class="w-75" id=<?php echo $temas->id_tema ?> name="hrs_dia[]"
                            value="<?php 
                                foreach($datos['segui_temas'] as $segui){
                                  if (($segui->fecha == $_GET['fecha']) && ($segui->id_tema==$temas->id_tema)) {
                                    echo $segui->horas_dia;                                  
                                    }
                                };
                            ?>"                        
                            >
                          </td>

                      </tr>
                      <?php }endforeach ?>
                    </tbody>
                  </table>
              </div>



              <div class="col-5">

                  <div class="row w-75 mt-4">
                      <textarea class="w-100" name="plan" id="plan" rows="5" placeholder="Plan previsto"><?php foreach($datos['segui_temas'] as $segui){if (($segui->fecha == $_GET['fecha'])){echo $segui->plan;}};?></textarea>
                  </div>

                  <div class="row w-75 mt-3">
                      <textarea class="w-100" name="act" id="act" rows="5" placeholder="Actividad realizada"><?php foreach($datos['segui_temas'] as $segui){if (($segui->fecha == $_GET['fecha'])){echo $segui->actividad;}};?></textarea>
                  </div>

                  <div class="row w-75 mt-3">
                      <textarea class="w-100" name="observaciones" id="observaciones" rows="5" placeholder="Observaciones"><?php foreach($datos['segui_temas'] as $segui){if (($segui->fecha == $_GET['fecha'])){echo $segui->observaciones;}};?></textarea>
                  </div>

                      <div class="row w-75 mt-3">
                        <div class="input-group">
                          <label for="activi" class="input-group-text">Otras actividades</label>
                          <input type="text" class="form-control form-control-md"
                            id="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Actividades"){
                                  echo $tem->id_tema; }} ?>"
                            name="hrs_dia[]"
                            value="<?php 
                                foreach($datos['segui_temas'] as $segui){
                                  foreach($datos['temas'] as $temas){
                                  if (($segui->fecha == $_GET['fecha']) && ($segui->id_tema==$temas->id_tema) && ($temas->descripcion=="Actividades")) {
                                    echo $segui->horas_dia;                                  
                                    }
                                }};
                            ?>" 
                          >
                          <input type="hidden" name="temas[]"
                              value="<?php foreach ($datos['temas'] as $tem) {
                            if ($tem->descripcion == "Actividades") {
                              echo $tem->id_tema;
                            }
                          } ?>">

                        </div>
                      </div>


                      <div class="row w-75 mt-4">
                        <h5 class="mt-3">No impartidas</h5>
                        <div class="input-group">
                          <label for="faltas" class="input-group-text">Faltas profesor</label>
                          <input type="text" class="form-control form-control-md"
                             name="hrs_dia[]"
                             id="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Faltas"){
                                  echo $tem->id_tema; }} ?>"
                             value="<?php 
                                foreach($datos['segui_temas'] as $segui){
                                  foreach($datos['temas'] as $temas){
                                  if (($segui->fecha == $_GET['fecha']) && ($segui->id_tema==$temas->id_tema) && ($temas->descripcion=="Faltas")) {
                                    echo $segui->horas_dia;                                  
                                    }
                                }};
                            ?>"
                            >
                            <input type="hidden" name="temas[]"
                              value="<?php foreach ($datos['temas'] as $tem) {
                              if ($tem->descripcion == "Faltas") {
                                echo $tem->id_tema;
                              }
                            } ?>">
                        </div>
                      </div>


                      <div class="row w-75 mt-3">
                        <div class="input-group">
                          <label for="otros" class="input-group-text">Otras motivos</label>
                          <input type="text" class="form-control form-control-md"
                              id="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Otros"){
                                  echo $tem->id_tema; }} ?>"
                            name="hrs_dia[]"
                            value="<?php 
                                foreach($datos['segui_temas'] as $segui){
                                  foreach($datos['temas'] as $temas){
                                  if (($segui->fecha == $_GET['fecha']) && ($segui->id_tema==$temas->id_tema) && ($temas->descripcion=="Otros")) {
                                    echo $segui->horas_dia;                                  
                                    }
                                }};
                            ?>"
                            >
                            <input type="hidden" name="temas[]"
                              value="<?php foreach ($datos['temas'] as $tem) {
                              if ($tem->descripcion == "Otros") {
                                echo $tem->id_tema;
                              }
                            } ?>">
                        </div>
                      </div>
              </div>

          </div>
          </div>

              <!-- FOOTER -->
              <div class="modal-footer">
                <input type="hidden" name="fecha" id="fecha" value="<?php echo $_GET['fecha'] ?>">
                <input type="hidden" name="id_modulo" id="id_modulo" value="<?php echo $datos['datos_modulo'][0]->id_modulo ?>" >
                <input type="submit" style="font-weight:bold" class="btn btn-primary text-white mb-3 mt-3 me-3" data-bs-dismiss="modal" value="Guardar*">
              </div>

          </form>

      </div>
      </div>
      </div>




          <!-- MODAL DIAS SIN CLASES -->
          <div class="modal fade" id="fiesta">
          <div class="modal-dialog modal-lg modal-dialog-centered ">
          <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="h4">
                <?php echo $dia_formato;
                foreach ($datos['horario_semana'] as $h_sem) {
                  if ($dia_semana[0] == $h_sem->id_horario) {
                    echo ' (' . $h_sem->total_horas . ' horas)';
                  }}?>
                  <p id="dia" name="dia"></p>
               </h4>
                <button style="background-color:white" type="button" class="btn-close me-3" data-bs-dismiss="modal" onclick="limpiar_campo()"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <h4 id="texto_modal"></h4>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
              <form id="form_anadir" action="<?php echo RUTA_URL ?>/profeSegui/segui_dia" method="post" onsubmit="siguiente()"> 
                <input type="hidden" name="fecha" id="fecha" value="<?php echo $_GET['fecha'] ?>">
                <input type="hidden" name="id_modulo" id="id_modulo" value="<?php echo $datos['datos_modulo'][0]->id_modulo ?>" > 
                <input type="hidden" name="festivo" value="festivo">
                <input type="submit" style="font-weight:bold" class="btn btn-primary text-white mb-3 mt-3 me-3" data-bs-dismiss="modal" value="Dia Siguiente">
              </form>
              </div>

          </div>
          </div>
          </div>





            <!-- MODAL BORRAR TEMAS DEL DIA -->
            <div class="modal" id="borrar">
            <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-white">Borrar tema</h4>
                  <button style="background-color:white" type="button" class="btn-close me-3" data-bs-dismiss="modal"></button>
                </div>

                <form action="<?php echo RUTA_URL?>/profeSegui/borrar_segui_tema" method="post">
                  <!-- Modal body -->
                  <div class="modal-body">
                      <input type="hidden" name="borrado" id="borrado">
                      <input type="hidden" name="id_modulo" value="<?php echo $datos['datos_modulo'][0]->id_modulo?>">
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <input type="submit" style="font-weight:bold" type="button" class="btn btn-primary text-white mb-3 mt-3 me-3" value="Borrar">
                  </div>
                </form>

            </div>
            </div>
            </div>
        



 

    <!-- The Modal -->
     <!-- <div class="modal fade" id="mi_modal">
      <div class="modal-dialog modal-lg modal-dialog-centered ">
        <div class="modal-content">  -->


          <!-- Modal Header -->
          <!-- <div class="modal-header bg-primary">
            <h4 class="modal-title text-white" id="h4"><p id="dia" name="dia"></p></h4>
            <button style="background-color:white" type="button" class="btn-close me-3" data-bs-dismiss="modal"
            onclick="limpiar_campo()"></button>
          </div>  -->


<!-- 
      <form id="form_anadir" action="<?php echo RUTA_URL?>/profeSegui/segui_dia" method="post" onsubmit="siguiente()">  -->

        <!-- Modal body -->
         <!-- <div class="modal-body">
           <div class="row">
              <div class="col-7">
                  <table id="tabla" style="margin-top:20px" class="table table-bordered w-50 text-center">
                    <thead>
                      <tr>
                        <th></th>
                        <th style="font-size:15px">Horas previstas</th>
                        <th style="font-size:15px">Horas impartidas</th>
                        <th style="font-size:15px">Horas/dia</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php  foreach($datos['temas'] as $temas):
                        if( ($temas->descripcion!="Faltas") && ($temas->descripcion!="Otros") && ($temas->descripcion!="Actividades")) {?>
                      <tr>
                          <td style="font-size:15px" nowrap>
                          <?php if ($temas->descripcion=='Examenes'){
                            echo "Examenes";
                          }else{
                            echo "Tema ".$temas->tema;
                          }?>
                            <input type="hidden" name="temas[]" value="<?php echo $temas->id_tema?>">
                          </td>
                          <td style="font-size:15px"><?php echo $temas->total_horas.' hrs'?></td>
                          <td style="font-size:15px">horas faltan</td>
                          <td style="font-size:15px"><input type="text" class="w-75" id=<?php echo $temas->id_tema?> name="hrs_dia[]"></td>
                      </tr>
                      <?php } endforeach ?>
                    </tbody>
                  </table>
              </div> -->


<!-- 
               <div class="col-5">
                  <div class="row w-75 mt-4">
                    <textarea class="w-100" name="plan" id="plan" rows="5" placeholder="Plan previsto"></textarea>
                  </div>
                  <div class="row w-75 mt-3">
                    <textarea class="w-100" name="act" id="act" rows="5" placeholder="Actividad realizada"></textarea>
                  </div>
                  <div class="row w-75 mt-3">
                    <textarea class="w-100" name="observaciones" id="observaciones" rows="5" placeholder="Observaciones"></textarea>
                  </div>

                          <div class="row w-75 mt-3">
                            <div class="input-group">
                              <label for="activi" class="input-group-text">Otras actividades</label>

                              <input type="text" class="form-control form-control-md"
                              id="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Actividades"){
                                  echo $tem->id_tema; }} ?>" name="hrs_dia[]">

                              <input type="hidden" name="temas[]"
                                value="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Actividades"){
                                  echo $tem->id_tema; }} ?>">
                                  
                            </div>
                          </div>

                          <div class="row w-75 mt-4">
                            <h5 class="mt-3">No impartidas</h5>
                            <div class="input-group">
                              <label for="faltas" class="input-group-text">Faltas profesor</label>
                              <input type="text" class="form-control form-control-md"
                               id="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Faltas"){
                                  echo $tem->id_tema; }} ?>" name="hrs_dia[]">
                              <input type="hidden" name="temas[]"
                                value="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Faltas"){
                                  echo $tem->id_tema; }} ?>">
                            </div>
                          </div>

                          <div class="row w-75 mt-3">
                            <div class="input-group">
                              <label for="otros" class="input-group-text">Otras motivos</label>
                              <input type="text" class="form-control form-control-md"
                              id="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Otros"){
                                  echo $tem->id_tema; }} ?>" name="hrs_dia[]">
                              <input type="hidden" name="temas[]"
                                value="<?php foreach ($datos['temas'] as $tem){
                                if($tem->descripcion=="Otros"){
                                  echo $tem->id_tema; }} ?>">
                            </div>
                          </div>


             </div>
            </div> -->

              <!-- <input type="hidden" name="fecha" id="fecha">
              <input type="hidden" name="id_modulo" id="id_modulo" value="<?php echo $datos['datos_modulo'][0]->id_modulo?>" >

          </div>  -->
<!-- 

           <div class="modal-footer">
            <input type="submit" style="font-weight:bold" class="btn btn-primary text-white mb-3 mt-3 me-3" data-bs-dismiss="modal"  value="Dia Siguiente">
            <input type="submit" style="font-weight:bold" class="btn btn-primary text-white mb-3 mt-3 me-3" data-bs-dismiss="modal" value="Guardar">
          </div>
      </form> 

         </div>
      </div>
    </div>  -->


    </article>

</body>
</html>







<script>





  function limpiar_campo(){
    var array=<?php echo json_encode($datos['temas']);?>;
    console.log(array);
     for (i=0;i<array.length;i++){
       var tema=document.getElementById(array[i].id_tema)
       tema.setAttribute("value","")
     }

      var plan=document.getElementById("plan")
      plan.setAttribute("value",'')
      plan.innerHTML=""


      var act=document.getElementById("act")
      act.setAttribute("value",'')
      act.innerHTML=""

      var observaciones=document.getElementById("observaciones")
      observaciones.setAttribute("value",'')
      observaciones.innerHTML=""

    var dia=document.getElementById("dia")
    var dia_modi=document.getElementById("dia_modi")
    //dia.removeChild(dia_modi)

     //MODIFICAMOS URL para poder abrir la modal otra vez
    var URLactual = window.location.href;
    //console.log(URLactual)
    var url_nueva = URLactual.indexOf('&');
    window.location.href = URLactual.substring(0, url_nueva);

  }



  function siguiente(){
    var dia_actual= document.getElementById('fecha').value
    dia_actual=dia_actual.split('-')
    var dia= parseInt(dia_actual[2])
    var actual=(dia)+(1)
    actual=new Date(dia_actual[0],dia_actual[1],actual)
  }


//var matches = document.querySelectorAll('fc-daygrid-day');

//console.log(matches)


//console.log(celda)
//console.log(celda.querySelectorAll('fc-daygrid-day'))
// var fila = tabla[0].getElementsByTagName("tr");
// console.log(fila)

//         var fila = tabla.getElementsByTagName("tr");




// console.log(celda)
// var valor=celda.getAttribute('data-date')
// console.log(valor)

  

//var valor=celda.getAttibute('data-date')
//console.log(valor)
          

         // console.log(celda)
          //var valor=celda[0].getAttribute('class')
         // console.log("valor")




</script>




