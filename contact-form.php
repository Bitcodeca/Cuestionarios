<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '/home/bitcodeweb/public_html/encuesta/phpmailer/PHPMailerAutoload.php';

if (isset($_POST['p0'])) {
    if (empty($_POST['p0'])) {
        $data = array('success' => false, 'message' => 'Por favor, llene el formulario.');
        echo json_encode($data);
        exit;
    }
    
    $p1='';
    $p2='';
    $p3='';
    $p4='';
    $p5='';
    $p6='';


    if (isset($_POST['p1'])) {
        if (!empty($_POST['p1'])) {
            $p1=$_POST['p1'];
        }
    }

    if (isset($_POST['p2'])) {
        if (!empty($_POST['p2'])) {
             foreach ($_POST['p2'] as $ap1) {
                $p2=$p2. ' ' .$ap1;
                if($ap1=='otro'){
                    if (isset($_POST['ap2a'])) {
                        if (!empty($_POST['ap2a'])) {
                            $p2=$p2.': '.$_POST['ap2a'];
                        }
                    }
                }
            }
        }
    }

    if (isset($_POST['p3'])) {
        if (!empty($_POST['p3'])) {
            $p3=$_POST['p3'];
        }
    }

    if (isset($_POST['p4'])) {
        if (!empty($_POST['p4'])) {
            $p4=$_POST['p4'];
            if($p4=='Si') {
                if (isset($_POST['ap4a'])) {
                    if (!empty($_POST['ap4a'])) {
                        $p4=$p4.': '.$_POST['ap4a'];
                    }
                }
            }
        }
    }

    if (isset($_POST['p6'])) {
        if (!empty($_POST['p6'])) {
            $p6=$_POST['p6'];
        }
    }
    

    if (isset($_POST['p5'])) {
        if (!empty($_POST['p5'])) {
             foreach ($_POST['p5'] as $ap1) {
                $p5=$p5.' '.$ap1;
                if($ap1=='otro'){
                    if (isset($_POST['ap5a'])) {
                        if (!empty($_POST['ap5a'])) {
                            $p5=$p5.': '.$_POST['ap5a'];
                        }
                    }
                }
            }
        }
    }

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';                      
    $mail->From = $_POST['p0'];
    $mail->FromName = $_POST['p0'];
    $mail->AddAddress('fcastillo90@gmail.com');
    $mail->Subject = 'Respuesta de Encuesta';


    $mail->Body = '¿Qué tipo de comercio tienes?
    ' .$p1 . "\r\n\r\n" .'
    ¿Usas algún sistema?
    '. $p2 . "\r\n\r\n" . '
    ¿Es de fácil manejo?
    '. $p3 . "\r\n\r\n" . '
    ¿Tiene alguna desventaja para ti?
    '. $p4 . "\r\n\r\n" . '
    ¿Monitoreas desde tu teléfono algún procesos?
    ' . $p5 . "\r\n\r\n" . '
    ¿Algún comentario adicional?
    ' . $p6;

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => '¡Muchas gracias por participar!');
    echo json_encode($data);

} else {
    $data = array('success' => false, 'message' => 'Por favor, termine de llenar el formulario.');
    echo json_encode($data);
}
?>