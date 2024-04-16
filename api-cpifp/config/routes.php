<?php
use Slim\Http\Response;
use Slim\Http\ServerRequest;

use App\Middleware\SesionMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('', function (RouteCollectorProxy $group) {
        
        ////////////////////////////////    CPIFP   /////////////////////////

        $group->get('/profesores', \App\Controller\Cpifp\Profesores::class);
        $group->get('/tecnicos', \App\Controller\Cpifp\Tecnicos::class);
        $group->get('/roles', \App\Controller\Cpifp\Roles::class);
        $group->post('/crear_profesor', \App\Controller\Cpifp\CrearProfesor::class);
        $group->post('/modificar_profesor', \App\Controller\Cpifp\ModificarProfesor::class);
        $group->post('/borrar_profesor', \App\Controller\Cpifp\BorrarProfesor::class);
        $group->get('/profesor_departamento/{id_departamento}', \App\Controller\Cpifp\ProfDep::class);
        $group->get('/comunicacion', \App\Controller\Cpifp\Comunicacion::class);
        $group->post('/cambiar_password/{password}/{id_profesor}', \App\Controller\Cpifp\CambiaContraseña::class);
        $group->post('/enviar_email', \App\Controller\Cpifp\EnviarCorreo::class);
        
        #$group->post('/login_token', \App\Controller\Cpifp\LoginToken::class);
        $group->post('/add_profesor_modulo', \App\Controller\Cpifp\AddProfModulo::class);
        $group->get('/profesor/{id_profesor}', \App\Controller\Cpifp\GetProfesor::class);
        $group->get('/departamentos', \App\Controller\Cpifp\Departamentos::class);
        $group->post('/crear_departamento', \App\Controller\Cpifp\CrearDepartamento::class);
        $group->post('/modificar_departamento', \App\Controller\Cpifp\ModificarDepartamento::class);
        $group->post('/borrar_departamento', \App\Controller\Cpifp\BorrarDepartamento::class);
        $group->get('/get_departamentos/{id_profesor}', \App\Controller\Cpifp\GetDepartamentos::class);
        $group->get('/get_departamento/{id_departamento}', \App\Controller\Cpifp\GetDepartamento::class);
        $group->post('/add_profesor_departamento', \App\Controller\Cpifp\AddProfDepartamento::class);
        $group->post('/modificar_profesor_departamento', \App\Controller\Cpifp\ModificarProfDep::class);
        $group->post('/borrar_profesor_departamento', \App\Controller\Cpifp\BorrarProfDep::class);
        $group->get('/rol/{id_profesor}', \App\Controller\Cpifp\GetRol::class);
        $group->get('/ciclos', \App\Controller\Cpifp\Ciclos::class);
        $group->post('/crear_ciclo', \App\Controller\Cpifp\CrearCiclo::class);
        $group->post('/modificar_ciclo', \App\Controller\Cpifp\ModificarCiclo::class);
        $group->post('/borrar_ciclo', \App\Controller\Cpifp\BorrarCiclo::class);
        $group->get('/modulos/{id_ciclo}', \App\Controller\Cpifp\Modulos::class);
        $group->post('/add_modulo', \App\Controller\Cpifp\AddModulo::class);
        $group->post('/modificar_modulo', \App\Controller\Cpifp\ModificarModulo::class);
        $group->post('/borrar_modulo', \App\Controller\Cpifp\BorrarModulo::class);
        $group->get('/cursos/{id_ciclo}', \App\Controller\Cpifp\Cursos::class);


         ////////////////////////////////    Mantenimiento   /////////////////////////

        $group->get('/incidencias', \App\Controller\Mantenimiento\Incidencias::class);
        $group->get('/incidencia/{id_incidencia}', \App\Controller\Mantenimiento\GetIncidencia::class);
        $group->get('/incidenciaJefe/{id_profesor}', \App\Controller\Mantenimiento\IncidenciaJefe::class);
        $group->post('/crear_incidencia', \App\Controller\Mantenimiento\CrearIncidencia::class);
        $group->post('/modificar_incidencia', \App\Controller\Mantenimiento\ModificarIncidencia::class);
        $group->post('/borrar_incidencia', \App\Controller\Mantenimiento\BorrarIncidencia::class);
        $group->post('/atender_incidencia/{id_incidencia}/{observaciones}/{id_tec_atiende}', \App\Controller\Mantenimiento\AtenderIncidencia::class);
        $group->post('/reabrir_incidencia/{id_incidencia}', \App\Controller\Mantenimiento\ReabrirIncidencia::class);
        $group->post('/repro_incidencia/{id_incidencia}', \App\Controller\Mantenimiento\ReproIncidencia::class);
        $group->post('/cerrar_incidencia/{id_incidencia}/{observaciones}/{horas}', \App\Controller\Mantenimiento\CerrarIncidencia::class);
        $group->get('/urgencia/{id_urgencia}', \App\Controller\Mantenimiento\GetUrgencia::class);
        $group->get('/urgencias', \App\Controller\Mantenimiento\Urgencias::class);
        $group->get('/estados', \App\Controller\Mantenimiento\Estados::class);

        $group->get('/edificios', \App\Controller\Mantenimiento\Edificios::class);
        $group->post('/crear_edificio', \App\Controller\Mantenimiento\CrearEdificio::class);
        $group->post('/modificar_edificio', \App\Controller\Mantenimiento\ModificarEdificio::class);
        $group->post('/borrar_edificio', \App\Controller\Mantenimiento\BorrarEdificio::class);
        $group->get('/ubicaciones', \App\Controller\Mantenimiento\Ubicaciones::class);
        $group->get('/aulas/{id_edificio}', \App\Controller\Mantenimiento\Aulas::class);
        $group->post('/crear_ubicacion', \App\Controller\Mantenimiento\CrearUbicacion::class);
        $group->post('/modificar_ubicacion', \App\Controller\Mantenimiento\ModificarUbicacion::class);
        $group->post('/borrar_ubicacion', \App\Controller\Mantenimiento\BorrarUbicacion::class);


    ////////////////////////////////    Permisos   /////////////////////////

        $group->get('/tipos_permiso/{id_profesor}', \App\Controller\Permisos\GetTiposPermiso::class);
        $group->post('/add_permiso', \App\Controller\Permisos\AddPermiso::class);
        $group->post('/permiso/enviarEmail', \App\Controller\Permisos\enviarEmailPermiso::class);
        $group->get('/permisos/{id_profesor}', \App\Controller\Permisos\PermisosProfesor::class);
        $group->post('/del_permiso', \App\Controller\Permisos\DelPermiso::class);
        $group->post('/subir_archivos', \App\Controller\Permisos\SubirArchivos::class);
        $group->post('/del_archivo', \App\Controller\Permisos\DelArchivo::class);
        $group->get('/permisos_activos', \App\Controller\Permisos\GetPermisosActivos::class);
        $group->post('/cambiar_estado_permiso', \App\Controller\Permisos\CambiarEstadoPermiso::class);
        $group->get('/todos_permisos', \App\Controller\Permisos\GetTodosPermisos::class);

        
    ////////////////////////////////    Encuestas   ////////////////////////////


    })->add(SesionMiddleware::class);
    

    $app->post('/login', \App\Controller\Cpifp\LoginToken::class);
    $app->post('/email/{email}', \App\Controller\Cpifp\CheckEmail::class);
    $app->post('/enviar_codigo', \App\Controller\Cpifp\EnviarCodigo::class);
    $app->post('/insertar_codigo/{email}/{codigo}', \App\Controller\Cpifp\InsertCodigo::class);
    $app->post('/codigo/{email}/{codigo}', \App\Controller\Cpifp\CheckCodigo::class);
    $app->post('/recovery', \App\Controller\Cpifp\RecoveryPass::class);

   
};
