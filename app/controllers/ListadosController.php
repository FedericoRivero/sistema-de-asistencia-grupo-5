<?php

namespace App\controllers;
use App\controllers\BaseController;
use App\models\Alumno;
use App\models\Cursos;
use App\models\Asistencia;
 

class ListadosController extends BaseController {

	public function getListarcurso($request)
        {    $cursos=Cursos::all();
                      return $this->renderHTML('listado_cursos.twig' , ["cursos"=>$cursos]);

        }
    public function getListaralumnos($request)
        {  
          $dato_post=$request -> GetParsedBody();//convierte los datos que recibe request
         
         $curso_seleccionado=$dato_post['id'];
         $alumnos=Alumno::all();
         //JOIN se utiliza para combinar dos o más tablas, tomando un campo común de las dos
         $iden=Alumno::join("asiste", "asiste.email", "=", "alumnos.email")
         ->where("asiste.nombre_curso", "=", $curso_seleccionado)
         ->where("asiste.estado", "=", "P")
         ->select("alumnos.nombre", "alumnos.email")
         ->get();

         // https://parzibyte.me/blog/2020/02/10/join-laravel-union-tablas-sql/
       return $this->renderHTML('listado_cursos.twig' , ["alumnos"=>$alumnos,"cs"=> $curso_seleccionado,"alu"=> $iden]);
           
    }
    public function getListartodosalumnos($request)
        {    $alumno=Alumno::all();
           // $alumnos=Alumno::all();
           return $this->renderHTML('listar_alumnos.twig' , ["alumnos"=>$alumno]);
            //b
         //$dato_post=$request -> GetParsedBody();//convierte los datos que recibe request
         //a
         //$nuevo_alumno=new Alumno();
         //$curso_seleccionado=$dato_post['nombrec'];
         //Consulto en la tabla asiste 
        // $consulta=Asiste::where('nombre_curso','$curso_seleccionado')->get();
         //return $this->renderHTML('listado_por_curso.twig',["listadoAsistente"=>$consulta,"curso_seleccionado"=>$curso_seleccionado]);
         //Campo de la BD igual que el name del imput.
         //Elocuente mapea y crea accesores de todos los campos
         //Elocuent es el ODM que facilita guardr los datos
         //El post se accede gracias al capturador de requels de la linea b)
         //$nuevo_alumno->nombre=$dato_post['nombre'];
         //$nuevo_alumno->save();
         //$cursos=curso::all();
         //$alumnos=Alumno::all();
       // return $this->renderHTML('home.twig' , ["listadoAlumnos"=>$alumnos,"cursos"=>$cursos,]);
    }
    public function editaralumnos($request)
    {   //b
         $dato_post=$request -> GetParsedBody();//convierte los datos que recibe request
         //Campo de la BD igual que el name del imput.
         //Elocuente mapea y crea accesores de todos los campos
         //Elocuent es el ODM que facilita guardr los datos
         //El post se accede gracias al capturador de requels de la linea b)
         $nuevo_alumno=$dato_post['id'];
  
         $iden=Alumno::where('alumnos.email', '=',$nuevo_alumno)
                ->select('nombre', 'email')
                ->get();

        return $this->renderHTML('editar_alumnos.twig' , ["listadoAlumnos"=>$iden]);
    }
    //modifica los datos del alumno
    public function modificaralumnos($request)
    {   //b
         $dato_post=$request -> GetParsedBody();//convierte los datos que recibe request
         //Campo de la BD igual que el name del imput.
         //Elocuente mapea y crea accesores de todos los campos
         //Elocuent es el ODM que facilita guardr los datos
         //El post se accede gracias al capturador de requels de la linea b)
         $id=$dato_post['id'];
         $nuevo_nom=$dato_post['nombre'];
         var_dump($nuevo_nom);
         $iden=Alumno::where('alumnos.email', '=',$id)
         ->update(["alumnos.nombre" => $nuevo_nom]);

         /* 
         $cambios=Alumnos::where('alumnos.email', 'pedro.23@gmail.com')
         ->select('nombre', 'email')
         ->get();
       //->update(['alumnos.nombre' => $nuevo_nom]);
        $cambios=Alumnos::where('alumnos.email', '=','$id')
         ->update(["alumnos.nombre" => $nuevo_nom])
         ->get();*/

         return $this->renderHTML('ayuda.twig');
    }
   }

?>