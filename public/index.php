<?php

ini_set('display_errors', 1);
ini_set('display_startup', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
session_start();

if (file_exists("../.env")) {
	$dotenv = new Dotenv\Dotenv(__DIR__ .'/..');
	$dotenv->load();
}

use Aura\Router\RouterContainer;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
		'driver'    => getenv('DB_DRIVER'),
		'host'      => getenv('DB_HOST'),
		'database'  => getenv('DB_NAME'),
		'username'  => getenv('DB_USER'),
		'password'  => getenv('DB_PASS'),
		'charset'   => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix'    => '',
	]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$contenedorDeRutas = new RouterContainer();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
	$_SERVER,
	$_GET,
	$_POST,
	$_COOKIE,
	$_FILES
);

$mapa = $contenedorDeRutas->getMap();

$mapa->get(
	'home',
	'/sistema-de-asistencia-grupo-5/',
	['controller'=>'App\controllers\HomeController','action'=>'getHome']
);

$mapa->get(
	'nosotros',
	'/sistema-de-asistencia-grupo-5/nosotros',
	['controller'=>'App\controllers\HomeController','action'=>'getNosotros']
);

$mapa->get(
	'admin',
	'/sistema-de-asistencia-grupo-5/admin',
	['controller'=>'App\controllers\HomeController','action'=>'getHomeAdmin']
);

$mapa->get(
	'formulario_inscripcion',
	'/sistema-de-asistencia-grupo-5/inscripcion',
	['controller'=>'App\controllers\InscripcionController','action'=>'getForminscripcion']
);

//ruta de tipo post para el carga del formulario en la base de datos
$mapa->post('formulario_inscripcion_store',
		 '/sistema-de-asistencia-grupo-5/inscripcion_realizada',
		 ['controller'=>'App\controllers\InscripcionController',
		 'action'=>'storeForminscripcion']);

//ruta de tipo get para el mostrar el formulario donde aparecen todos los cursos y la opción de ver los que asistieron
$mapa->get('form_listado_de_cursos',
		 '/sistema-de-asistencia-grupo-5/form_listado_cursos',
		 ['controller'=>'App\controllers\ListadosController',
		 'action'=>'getListarcurso']);

$mapa->get(
		'formulario_registro',
		'/sistema-de-asistencia-grupo-5/registro',
		['controller'=>'App\controllers\InscripcionController','action'=>'getFormregistro']);
		
//ruta para login de administradores//
$mapa->get(
	'login',
	'/sistema-de-asistencia-grupo-5/login',
	['controller'=>'App\controllers\LoginController','action'=>'getSesion']
);

//ruta de tipo post para el carga del formulario en la base de datos
$mapa->post('formulario_registro_store',
		 '/sistema-de-asistencia-grupo-5/registro_realizado',
		 ['controller'=>'App\controllers\InscripcionController',
		 'action'=>'storeFormregistro']);

 $mapa->get('form_listado_de_cursos_para_asistencia',
		 '/sistema-de-asistencia-grupo-5/asistencia',
		 ['controller'=>'App\controllers\ListadosController',
		 'action'=>'getListarcursosasistencia']);


if ($_SERVER["REQUEST_METHOD"] == "POST")
 {		$name = $_POST['subject']; 
	if ($name=="Alumnos Inscriptos") 
	{
//ruta de tipo post para el mostrar los alumnos presentes en un curso
$mapa->post('listar alumnos','/sistema-de-asistencia-grupo-5/', ['controller'=>'App\controllers\ListadosController','action'=>'getListaralumnos']);
	}
	if ($name=="Listado de Asistencia") 
	{
//ruta de tipo post para el mostrar los alumnos presentes en un curso
$mapa->post('listar alumnos para asistencia','/sistema-de-asistencia-grupo-5/', ['controller'=>'App\controllers\ListadosController','action'=>'getListarasistencia']);
	}
 
   if ($name=="Registrar Asistencia") 
   {
		//ruta de tipo post para registrar la asistencia
		$mapa->post('registrar asistencia','/sistema-de-asistencia-grupo-5/', 
		['controller'=>'App\controllers\ListadosController','action'=>'registrarasistencia']);
   }

	if ($name=="Editar") 
	{
		$mapa->post('editar alumnos',
		'/sistema-de-asistencia-grupo-5/',
		['controller'=>'App\controllers\ListadosController','action'=>'editaralumnos']);
	}

	if ($name=="Modificar") 	
	{
		$mapa->post('modifica alumnos','/sistema-de-asistencia-grupo-5/', 
		['controller'=>'App\controllers\ListadosController','action'=>'modificaralumnos']);

	}

//Verificar login administrador
$mapa->post(
	'verificar',
	'/sistema-de-asistencia-grupo-5/login',
	['controller'=>'App\controllers\LoginController','action'=>'verificar']);

}

//ruta de tipo gets para listar todos los alumnos
$mapa->get('listar todos alumnos',
	'/sistema-de-asistencia-grupo-5/listado_alumnos',
 	['controller'=>'App\controllers\ListadosController','action'=>'getListartodosalumnos']);
	
//------Mach whit route-------------
$matcher = $contenedorDeRutas->getMatcher();

$route = $matcher->match($request);
//------Mach whit route-------------

if (!$route) {
	require '../views/404.html';
} else {

	$capturadorDeDatos = $route->handler;

	$nombreControlador = $capturadorDeDatos['controller'];
	$nombreDeFuncion   = $capturadorDeDatos['action'];
	$Autentificacion   = $capturadorDeDatos['auth']??false;

	$log = $_SESSION['login'][2]??null;

	if ($Autentificacion && !$log) {
		$controlador     = new App\controllers\loginController;
		$nombreDeFuncion = 'getLogin';
		$response        = $controlador->$nombreDeFuncion($request);
	} else {

		$controlador = new $nombreControlador;
		$response    = $controlador->$nombreDeFuncion($request);

	}

	echo $response->getBody();

}
