<?php

namespace App\controllers;
use App\controllers\BaseController;
use App\models\Alumno;
use App\models\Asistencia;
use App\models\Cursos;
use App\models\realiza;

class InscripcionController extends BaseController
{

    public function getForminscripcion()
    {
        $cursos = Cursos::all(); //obtiene el listado actual de cursos desde la BD
        $curso = $_GET['nombre_curso'];
        return $this->renderHTML('formInscripcion.twig', ['nombre_curso' => $curso]);
    }

    public function storeForminscripcion($request)
    {
        $dato_post = $request -> GetParsedBody();
        
        $nuevo_registro = new Realiza();
             
        $nuevo_registro -> email = $dato_post['email'];  
        $nuevo_registro -> nombre_curso = $dato_post['nombre_curso'];
        $nuevo_registro -> save();
        
        return $this->renderHTML('inscripcion_realizada.twig', []);

    }

    public function getFormregistro()
    {
        return $this->renderHTML('formRegistro.twig', []);
    }
    
    public function storeFormregistro($request)
    {
        $dato_post = $request -> GetParsedBody();
        
        $nuevo_registro = new Alumno();

        $nuevo_registro  -> nombre = $dato_post['nombre'];
        $nuevo_registro  -> apellido = $dato_post['apellido'];
        $nuevo_registro -> email = $dato_post['email'];
        $nuevo_registro -> dni = $dato_post['dni'];
        $nuevo_registro -> telefono = $dato_post['telefono'];
        $nuevo_registro -> save();
        
        return $this->renderHTML('registro_realizado.twig', []);

    }

}

?>