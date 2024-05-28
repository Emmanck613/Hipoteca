<?php 

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router-> render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        $router -> render('paginas/nosotros');
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();

        $router -> render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $ID = validarRedireccionar('/propiedades');
        
        $propiedad = Propiedad::find($ID);

        $router -> render('paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router -> render('paginas/blog');
    }

    public static function entrada(Router $router) {
        $router -> render('paginas/entrada');
    }

    public static function contacto(Router $router) {
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];

            //crear instancia de php mailer
            $mail = new PHPMailer();

            //confugrar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true; //auth usuario
            $mail->Username = '7d81145b1caabe';
            $mail->Password = '97e0ba4165496c';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //configurar el contenido del email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>'; 
            $contenido .= '<p>Nombre: ' . $respuestas['NOMBRE'] . ' </p>'; 

            //Condicional de forma de contacto
            if($respuestas['CONTACTO'] === 'TELEFONO'){
                $contenido .= '<p>Eligio ser contactado por telefono</p>'; 
                $contenido .= '<p>Telefono: ' . $respuestas['TELEFONO'] . ' </p>'; 
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['FECHA'] . ' </p>'; 
                $contenido .= '<p>Hora: ' . $respuestas['HORA'] . ' </p>'; 
                $contenido .= '</html>';
            } else {
                $contenido .= '<p>Eligio ser contactado por email</p>'; 
                $contenido .= '<p>Email: ' . $respuestas['EMAIL'] . ' </p>'; 
            }
            
            $contenido .= '<p>Mensaje: ' . $respuestas['MENSAJE'] . ' </p>'; 
            $contenido .= '<p>Vende o Compra: ' . $respuestas['TIPO'] . ' </p>'; 
            $contenido .= '<p>Presupuesto: $' . $respuestas['PRECIO'] . ' </p>'; 
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['CONTACTO'] . ' </p>'; 
    
            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alt sin html';

            //Enviar el email
            if ($mail->send() ){
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "Mensaje no enviado correctamente";
            }
       }
       
        $router -> render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

}