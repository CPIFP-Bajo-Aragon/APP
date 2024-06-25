<?php


//Para redireccionar la pagina
function redireccionar($pagina){
    header('location: ' . RUTA_URL . $pagina);
}


function tienePrivilegios($rol_usuario, $rolesPermitidos){
    // si $rolesPermitidos es vacio, se tendran privilegios
    if (empty($rolesPermitidos) || in_array($rol_usuario, $rolesPermitidos)) {
        return true;
    }
}


function obtenerRol($roles){
    $id_rol = 0;
    foreach($roles as $rol){
        if($rol->id_rol==30 && $id_rol < $rol->id_rol){           // Jefe Departamento
            $id_rol = 30;
        }elseif($rol->id_rol==50 && $id_rol < $rol->id_rol){           // Equipo directivo
            $id_rol = 50;
        }elseif(($rol->id_rol==10 || $rol->id_rol==20 || $rol->id_rol==40) && $id_rol < $rol->id_rol){        // Profesor o Tutor
            $id_rol = 10;
        }
    }

    return $id_rol;
}

/**funcion que calcula el día siguiente al día dado */
function diaSiguiente($diaActual)
{
     // INCREMENTAMOS EN UNO EL DÍA ACTUAL 
     $fecha_sig=explode('-',$diaActual);
     $dia_sig= mktime(0, 0, 0, $fecha_sig[1] , $fecha_sig[2]+1, $fecha_sig[0]);
     $dia_siguiente = date ("Y-m-j",$dia_sig);
     return $dia_siguiente;
}