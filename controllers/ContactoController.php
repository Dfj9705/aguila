<?php

namespace Controllers;


use Classes\Email;
use Exception;
use MVC\Router;

class ContactoController
{
    public static function enviar()
    {
        try {
            getHeadersApi();
            $grecaptcha = $_POST['g-recaptcha-response'];
            
            if (!isset($grecaptcha)) {
                echo json_encode([
                    'codigo' => 2,
                    'mensaje' => 'Token reCAPTCHA no proporcionado',
                ]);
                exit;
            }

            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = $_ENV['RECAPTCHA_SECRET_KEY'];
            $recaptcha_response = $grecaptcha;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $recaptcha_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
                'secret' => $recaptcha_secret,
                'response' => $recaptcha_response
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $recaptcha_result = curl_exec($ch);
            curl_close($ch);

            $recaptcha_data = json_decode($recaptcha_result);

            if (!$recaptcha_data->success) {
                echo json_encode([
                    'codigo' => 2,
                    'mensaje' => 'Verificación reCAPTCHA fallida',
                ]);
                exit;
            }
            

            if (isset($_POST['email'], $_POST['name'], $_POST['subject'], $_POST['message'])) {

                $email_address = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
                $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
                $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');


                if (filter_var($email_address, FILTER_VALIDATE_EMAIL) === false) {
                    echo json_encode([
                        'codigo' => 2,
                        'mensaje' => 'Dirección de correo invalida',
                    ]);
                    exit;
                }


                $email = new Email($email_address, $name);



                $enviado = $email->generateEmail($subject, [$_ENV['EMAIL_TO_ADDRESS']], $message)->send();

                if ($enviado) {
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Correo enviado exitosamente',
                    ]);
                } else {
                    echo json_encode([
                        'codigo' => 0,
                        'mensaje' => 'Error al enviar correo',
                    ]);
                }

            } else {
                echo json_encode([
                    'codigo' => 2,
                    'mensaje' => 'Faltan datos para enviar el correo',
                ]);
            }

        } catch (Exception $e) {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Ocurrió un error',
                'detalle' => $e->getMessage()
            ]);
        }
    }

}