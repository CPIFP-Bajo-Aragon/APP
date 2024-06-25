
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
   
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <title>Seguimiento</title>


  <!-- <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css"> -->



  <style>
    .boton {
      padding: 15px 25px;
      font-size: 20px;
      text-align: center;
      cursor: pointer;
      outline: none;
      color:white;
      background-color: #0b2a85 ;
      border: none;
      border-radius: 15px;
      width:200px;
    }

    .boton:hover {background-color: #f46116}

    .boton:active {
      background-color: #f46116;
      transform: translateY(4px);
    }
</style>

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



    
    <div class="container mt-5 mb-5">
      <div class="card d-flex justify-content-center align-items-center" style="background-color:#e9e9e9; border:solid 3px #0b2a85; border-radius:15px; margin-top:50px; margin:auto">
        <div class="card-body">
        <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">SEGUIMIENTO DE LA PROGRAMACION</h5>
          <?php foreach($datos['modulo'] as $mod):?>
              <a style="text-decoration:none; color:black;" href="<?php echo RUTA_URL ?>/profeSegui/diario/<?php echo $mod->id_modulo?>">
                <button type="button" class="boton text-white me-2 mb-3"><?php echo $mod->modulo?></button>
              </a> 
          <?php endforeach ?>
        </div>
      </div>
    </div>


    <?php if ($datos['usuarioSesion']->id_rol == 30) {?>
      <div class="card d-flex justify-content-center align-items-center me-5" style="background-color:#e9e9e9; border:solid 3px #0b2a85; width:300px; height:150px; border-radius:15px; margin:auto">
        <div class="card-body">
          <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">REPARTO DE HORAS</h5>
          <a style="text-decoration:none; color:black;" href="<?php echo RUTA_REPARTO?>">
            <button type="button" class="boton text-white mb-3">Reparto</button>
          </a> 
        </div>
      </div>
    <?php }?>


    <div class="container-fluid">
      <div class="row">   
          <?php if ($datos['usuarioSesion']->id_rol == 50) {?>
            <div class="card d-flex justify-content-center align-items-center" style="background-color:#e9e9e9; border:solid 3px #0b2a85; width:300px; height:150px; border-radius:15px; margin:auto">
              <div class="card-body">
                <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">CURSO LECTIVO</h5>
                <a style="text-decoration:none; color:black;" href="<?php echo RUTA_CURSO?>">
                  <button type="button" class="boton text-white mb-3">Nuevo curso</button>
                </a> 
              </div>
            </div>  
          <?php }?>      
      
      </div>      
    </div>

    <!-- Contenedor seguimiento -->
    <section class="container mt-5">
      <div class="row">   
          <?php if ($datos['usuarioSesion']->id_rol == 50) {?>
            <div class="card " style="background-color:#e9e9e9; border:solid 3px #0b2a85; width:300px; padding:16px; border-radius:15px; margin:auto">
            
              <div class="card-body ">
                <h5 class="card-title mt-2 mb-4 text-center" style="color:#0b2a85">GENERACIÓN DE INFORMES:</h5>
                <div class="d-flex justify-content-around align-items-center">
                  <a id="btnMostrarSeguimiento" style="text-decoration:none; color:black;" href="#">
                    <button type="button" class="boton text-white mb-3">Generar Informe en la web</button>
                  </a> 
                </div>
                
              </div>
            </div>  
          <?php }?>      
      
      </div>      
    </section>
    
    <!-- Contenedor que muestra el Informe, está oculto y se muestra al pulsar el botón -->
    <section class="container mt-5 informe" id="informe" hidden>
      <div class="informeWeb row" id="informeWeb">
        <div class="col-12">
          <!-- Datos módulo -->
          <div class="row datos-profesor">
            <table class="table table-hover col-12"  id="datosProfesor">
              <thead>
                <tr>
                  <th class="text-center" scope="col" colspan="8"><h4>Informe módulo Sistemas informáticos</h4></th>
                </tr>
                <tr>
                  <th scope="col">Abreviatura</th>
                  <th scope="col">Departamento</th>
                  <th scope="col">Código ciclo</th>
                  <th scope="col">Ciclo</th>
                  <th scope="col">Grado</th>
                  <th scope="col">Curso</th>
                  <th scope="col">Código</th>
                  <th scope="col">Profesor</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">SI</th>
                  <td>Informática</td>
                  <td>IFC303</td>
                  <td>Desarrollo de aplicaciones Web</td>
                  <td>Superior</td>
                  <td>1º</td>
                  <td>m0843</td>
                  <td>Javier Mallén Sorribas</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Indicador EP1 -->
          <div class="row EP1 mt-5">
            <table class="table table-hover col-12" id="EP1">
              <thead>
                <tr>
                  <th scope="col" colspan="9"><h5>Indicador EP1</h5></th>
                </tr>
                <tr>
                  <th scope="col">Octubre</th>
                  <th scope="col">Noviembre</th>
                  <th scope="col">Diciembre</th>
                  <th scope="col">Enero</th>
                  <th scope="col">Febrero</th>
                  <th scope="col">Marzo</th>
                  <th scope="col">Abril</th>
                  <th scope="col">Mayo</th>
                  <th scope="col">Junio</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>100%</td>
                  <td>90%</td>
                  <td>80%</td>
                  <td>80%</td>
                  <td>70%</td>
                  <td>100%</td>
                  <td>90%</td>
                  <td>80%</td>
                  <td>80%</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Indicador EP2 -->
          <div class="row EP2 mt-5" id="EP2">
            <table class="table table-hover col-12" id="EP2">
              <thead>
                <tr>
                  <th scope="col" colspan="3"><h5>Indicador EP2</h5></th>
                </tr>
                <tr>
                  <th scope="col">1ª Evaluación</th>
                  <th scope="col">2ª Evaluación</th>
                  <th scope="col">Final</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>100%</td>
                  <td>90%</td>
                  <td>80%</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Indicador AA -->
          <div class="row AA mt-5">
            <table class="table table-hover col-12" id="AA">
              <thead>
                <tr>
                  <th scope="col" colspan="4"><h5>Indicador AA</h5></th>
                </tr>
                <tr>
                  <th scope="col">1ª Evaluación</th>
                  <th scope="col">2ª Evaluación</th>
                  <th scope="col">3ª Evaluación</th>
                  <th scope="col">Global</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>100%</td>
                  <td>90%</td>
                  <td>90%</td>
                  <td>80%</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Indicador HI -->
          <div class="row HI mt-5">
            <table class="table table-hover col-12" id="HI">
              <thead>
                <tr>
                  <th scope="col" colspan="4"><h5>Indicador HI</h5></th>
                </tr>
                <tr>
                  <th scope="col">1ª Evaluación</th>
                  <th scope="col">2ª Evaluación</th>
                  <th scope="col">3ª Evaluación</th>
                  <th scope="col">Global</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>100%</td>
                  <td>90%</td>
                  <td>90%</td>
                  <td>80%</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Indicador AP -->
          <div class="row AP mt-5">
            <table class="table table-hover col-12" id="AP">
              <thead>
                <tr>
                  <th scope="col" colspan="4"><h5>Indicador AP</h5></th>
                </tr>
                <tr>
                  <th scope="col">1ª Evaluación</th>
                  <th scope="col">2ª Evaluación</th>
                  <th scope="col">FINAL</th>
                  <th scope="col">2ª Convocatoria</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>100%</td>
                  <td>90%</td>
                  <td>90%</td>
                  <td>80%</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Indicador AT -->
          <div class="row AT mt-5">
            <table class="table table-hover col-12" id="AT">
              <thead>
                <tr>
                  <th scope="col" colspan="3"><h5>Indicador AT</h5></th>
                </tr>
                <tr>
                  <th scope="col">1ª Evaluación</th>
                  <th scope="col">2ª Evaluación</th>
                  <th scope="col">Final</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>100%</td>
                  <td>90%</td>
                  <td>80%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>




      <div class="row btn-exportar mt-5" id="btn-exportar">
        <div class="col-12 d-flex justify-content-around">
          <a style="text-decoration:none; color:black;" href="#" id="btnCrearXLSX">
            <button type="button" class="boton text-white mb-3" style="background-color: #7cbb00;">Descargar Informe en Excel</button>
          </a> 
          <a style="text-decoration:none; color:black;" href="#" id="btnCrearPDF">
            <button type="button" class="boton text-white mb-3" style="background-color: #ff0000;">Descargar Informe en PDF</button>
          </a> 
        </div>
      </div>
    </section>
    <!-- CDN sheetjs y html2pdf -->
    <!-- <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-0.20.2/package/dist/xlsx.full.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo RUTA_URL ?>/public/js/segui.js"></script>
    

</body>
</html>
    
