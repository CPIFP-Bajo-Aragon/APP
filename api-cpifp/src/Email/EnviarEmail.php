<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

final class EnviarEmail
{

    public function __construct() {

    }

    public function sendEmail($to,$nombreTo,$asunto,$cuerpo,$conCopia,$from="informatica@cpifpbajoaragon.com",$nombreFrom="Departamento de Informática")
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
           /* $mail->Host       = 'n3plcpnl0021.prod.ams3.secureserver.net';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $from;                     // SMTP username
            $mail->Password   = 'contraseña';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;  */                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
            $mail->Host       = 'smtp.ionos.es';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//            $mail->Username   = $from;                     // SMTP username
			$mail->Username   = "noreply@cpifpbajoaragon.com";                     // SMTP username
            $mail->Password   = 'kvAPuHCKX9NSDZts$$py';                               // SMTP password
//            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//            $mail->Port       = 465; 
			$mail->Port       = 587;

            $mail->CharSet = 'UTF-8';

            //Recipients
//            $mail->setFrom($from, $nombreFrom);
			$mail->setFrom($from, $nombreFrom);
            $mail->addAddress($to, $nombreTo);
//            $mail->addReplyTo($from, $nombreFrom);
			$mail->addReplyTo($from, $nombreFrom);
            if ($conCopia){
//                $mail->addBCC($from);
				$mail->addBCC("informatica@cpifpbajoaragon.com");
            }
            

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $cuerpo;

            $mail->send();
//            $respuesta = 'El Mensaje ha sido enviado correctamente';
            $respuesta = '1'; 
        } catch (Exception $e) {
            $respuesta = "No se ha podido enviar el mensaje. Error: {$mail->ErrorInfo}";
           // $respuesta = '0';
        }

        return $respuesta;
    }

}