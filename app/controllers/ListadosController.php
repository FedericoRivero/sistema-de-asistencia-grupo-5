<?php

namespace App\controllers;
use App\controllers\BaseController;
use App\models\Alumno;
use App\models\Cursos;
use App\models\Asistencia;
use App\models\Realiza;
 

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
         $iden=Alumno::join("realiza", "realiza.email", "=", "alumnos.email")
         ->where("realiza.nombre_curso", "=", $curso_seleccionado)
        // ->where("asistencia.estado", "=", "P")
         ->select("alumnos.nombre", "alumnos.email","alumnos.apellido")
         ->get();

         // https://parzibyte.me/blog/2020/02/10/join-laravel-union-tablas-sql/
       return $this->renderHTML('listado_asistentes.twig' , ["alumnos"=>$alumnos,"cs"=> $curso_seleccionado,"alu"=> $iden]);
           
    }
    public function getListartodosalumnos($request)
        {    $alumno=Alumno::all();
         
           return $this->renderHTML('listar_alumnos.twig' , ["alumnos"=>$alumno]);
           
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
                ->select('nombre', 'email','apellido')
                ->get();

        return $this->renderHTML('editar_alumnos.twig' , ["listadoAlumnos"=>$iden]);
    }
    //modifica los datos del alumno
    public function modificaralumnos($request)
    {   
         $dato_post=$request -> GetParsedBody();//convierte los datos que recibe request
         
         $email=$dato_post['id'];
         var_dump($email);
         $nuevo_nom=$dato_post['nombre'];
         $nuevo_apell=$dato_post['apellido'];
         $nuevo_email=$dato_post['nuevo_email'];
       
         $iden=Alumno::where('alumnos.email', '=',$email)
         ->update(["alumnos.nombre" => $nuevo_nom,
         "alumnos.apellido" => $nuevo_apell,"alumnos.email" => $nuevo_email]);
         
         $iden=Realiza::where('realiza.email', '=',$email)
         ->update(["realiza.email" => $nuevo_email]);
         
         return $this->renderHTML('operacion_exitosa.twig');
    }
    public function registrarasistencia($request)
    {  $dato_post=$request ->GetParsedBody();

       $id=$dato_post['nombre_curso']; 
                      
        $registra_asistencia = new Asistencia();
     
        $registra_asistencia->email=$dato_post['email'];
        $registra_asistencia->nombre_curso=$dato_post['nombre_curso'];
        $registra_asistencia->estado=$dato_post['estado'];
        $registra_asistencia->save();
        
        return $this->renderHTML('operacion_exitosa.twig');
        
    }

    
   }

?>