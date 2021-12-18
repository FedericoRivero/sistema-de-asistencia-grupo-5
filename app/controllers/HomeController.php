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
        $nosotros = array(
            'María Eugenia Fernandez', 'Lorena Luna', 'Paola Perafán', 'Noel Montis Reus', 'Emmanuel Duart', 'Marcelo Aballay', 'Fernando Icazatti', 'Federico Rivero', 
            'Alicia Sepúlveda', 'Marcela Chacon', 'Ana Vega', 'Mária Martinez', 'Emmanuel Vega', 'Fiorella Riccobelli', 'Erica Montaña'
        );
        return $this -> renderHTML('nosotros.twig', ['nosotros' => $nosotros]);
    }

}

?>