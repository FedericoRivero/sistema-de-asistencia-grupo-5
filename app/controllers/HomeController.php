<?php

namespace App\controllers;
use App\controllers\BaseController;
use App\models\Alumno;


class HomeController extends BaseController {

	public function getHome()
    {
        //$fecha=explode(',',date('d,m,Y'));
        $skills=array('PHP','LARAVEL','MYSQL','HTML','CSS','JAVASCRIPT');
        //$fecha=new Fecha();

        return $this->renderHTML(
            'home.twig',
            [
                'listSkills'=>$skills
            ]
        );
    }

}

?>