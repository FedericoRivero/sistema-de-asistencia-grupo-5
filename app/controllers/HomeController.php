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
    
    public function getHomeAdmin()
    {
        //$fecha=explode(',',date('d,m,Y'));
        //$skills=array('PHP','LARAVEL','MYSQL','HTML','CSS','JAVASCRIPT');
        //$fecha=new Fecha();
        $skills = Cursos::all();
        
        return $this -> renderHTML(
            'home_admin.twig',
            ['listSkills'=>$skills]
        );
    }

    public function getNosotros()
    {
        $nosotros = array('PHP','LARAVEL','MYSQL','HTML','CSS','JAVASCRIPT');
        return $this -> renderHTML('nosotros.twig', ['nosotros' => $nosotros]);
    }

}

?>