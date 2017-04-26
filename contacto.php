<?php
    require('./phpmailer/PHPMailerAutoload.php');
    define( 'MAILER_CHARSET', 'utf-8' );
    //Comprobamos que se haya presionado el boton enviar
    if(isset($_POST['enviar'])){
        //Guardamos en variables los datos enviados
        $nombre = utf8_encode($_POST['name']);
        $apellido= utf8_encode($_POST['lname']);
        $email = utf8_encode($_POST['email']);
        $telefono = utf8_encode($_POST['phone']);
        $mensaje = utf8_encode($_POST['message']);
        ///Validamos del lado del servidor que el nombre y el email no estén vacios
        if($nombre == '')
        {
            echo "Debe ingresar su nombre";
        }
        else if($email == '')
        {
            echo "Debe ingresar su email";
        }
        else{
            //Este sería el cuerpo del mensaje
            $mensaje = "
                <table border='0' cellspacing='3' cellpadding='2'>
                    <tr>
                        <td width='30%' align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
                        <td width='80%' align='left'>$nombre</td>
                    </tr>
                    <tr>
                        <td width='30%' align='left' bgcolor='#f0efef'><strong>Nombre:</strong></td>
                        <td width='80%' align='left'>$apellido</td>
                    </tr>
                    <tr>
                        <td align='left' bgcolor='#f0efef'><strong>E-mail:</strong></td>
                        <td align='left'>$email</td>
                    </tr>
                    <tr>
                        <td width='30%' align='left' bgcolor='#f0efef'><strong>Teléfono:</strong></td>
                        <td width='70%' align='left'>$telefono</td>
                    </tr>
                    <tr>
                        <td align='left' bgcolor='#f0efef'><strong>Comentario:</strong></td>
                        <td align='left'>$mensaje</td>
                    </tr>
                </table>
                ";
         
            //STP
            $para = "cite@usb.ve";//Email al que se enviará
            $asunto = "Contacto desde web CITE";//Puedes cambiar el asunto del mensaje desde aqui
            $mail = new PHPMailer();
            $mail->PluginDir = "includes/";
            $mail->CharSet = 'UTF-8';
            $mail->From = $email;
            $mail->FromName = $nombre; 
            $mail->AddAddress($para); // Dirección a la que llegaran los mensajes.
            // Aquí van los datos que apareceran en el correo que reciba
            $mail->WordWrap = 50; 
            $mail->IsHTML(true);     
            $mail->Subject  =  $asunto; // Asunto del mensaje.
            $mail->Body     =  $mensaje;
            $mail->AltBody = $mensaje;

            // Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...

            $mail->IsSMTP(); 
            $mail->SMTPSecure = 'tls';
            $mail->Host = "smtp.gmail.com";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP

            //El puerto será el 587 ya que usamos encriptación TLS
            $mail->Port = 587;
            //$mail->AddReplyTo('$email','Mensaje enviado a CITE le responderemos lo mas pronto posible');
            $mail->SMTPAuth = true; 
            $mail->Username = "cite@usb.ve";  // Correo Electrónico
            $mail->Password = "mc9s08qe128"; // Contraseña del correo

         
            //Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
            if($mail->send())
            {
                echo "Su mensaje ha sido enviado con exito";
            }
            else
            {
                echo "Hubo un error en el envío inténtelo más tarde";
            }
        }
        
   }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contacto</title>
</head>
<body>
<script type="text/javascript">
    //window.alert("Su mensaje ha sido enciado con éxito. Le responderemos lo más pronto posible");
    function redireccionar(){
        window.location="index.html";
    } 
    setTimeout ("redireccionar()", 3000); //tiempo expresado en milisegundos
</script>";
</body>
</html>