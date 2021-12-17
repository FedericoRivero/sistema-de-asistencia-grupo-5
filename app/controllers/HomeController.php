<?php

namespace App\controllers;
use App\controllers\BaseController;
use App\models\Alumno;
use App\models\Cursos;

class HomeController extends BaseController {

	public function getHome()
    {
        //$fecha=explode(',',date('d,m,Y'));
        //$skills=array('PHP','LARAVEL','MYSQL','HTML','CSS','JAVASCRIPT');
        //$fecha=new Fecha();
        $skills = Cursos::all();
        
        return $this->renderHTML(
            'home.twig',
            ['listSkills'=>$skills]
        );
    }

}

?>