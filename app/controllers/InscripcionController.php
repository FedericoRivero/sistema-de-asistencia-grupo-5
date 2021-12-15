<?php

namespace App\controllers;
use App\controllers\BaseController;
use App\models\Alumno;
use App\models\Asistencia;
use App\models\Cursos;

class InscripcionController extends BaseController
{

    public function getForminscripcion()
    {
        $cursos = Cursos::all(); //obtiene el listado actual de cursos desde la BD
        
        return $this->renderHTML('formInscripcion.twig', ['cursos' => $cursos]);
    }

    public function storeForminscripcion($request)
    {
        $dato_post = $request -> GetParsedBody();
        
        $nueva_inscripcion = new Asistencia();

        $nueva_inscripcion -> email = $dato_post['email'];
        $nueva_inscripcion -> nombre_curso = $dato_post['nombre_curso'];
        $nueva_inscripcion-> save();
        
        return $this->renderHTML('inscripcion_realizada.twig', []);

    }

    public function getCursos()
    {
        

    }

}

?>