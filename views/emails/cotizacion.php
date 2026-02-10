<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #333;
                line-height: 1.6;
            }

            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
            }

            .header {
                border-bottom: 2px solid #0056b3;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .folio {
                font-weight: bold;
                color: #0056b3;
            }

            .footer {
                margin-top: 30px;
                font-size: 0.9em;
                color: #777;
                border-top: 1px solid #eee;
                padding-top: 10px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <h2>Confirmación de Solicitud de Cotización</h2>
            </div>
            <p>Estimado(a) <strong><?= $cotizacion->nombre ?></strong>,</p>
            <p>Hemos recibido correctamente tu solicitud de cotización. Nuestro equipo está revisando los requerimientos
                para brindarte la mejor propuesta posible.</p>

            <p><strong>Resumen de solicitud:</strong></p>
            <ul>
                <li><span>Detalles:</span> <?= $tipoServicio ?></li>
                <li><span>Fecha:</span> <?= $cotizacion->fecha ?></li>
                <li><span>Observaciones:</span> <?= $cotizacion->observaciones ?></li>
            </ul>

            <p>Un ejecutivo se pondrá en contacto contigo lo antes posible</p>

            <p>Gracias por tu interés en nuestros servicios.</p>

            <div class="footer">
                <p>Atentamente,<br>Vcards</p>
                <img src="cid:logo" alt="Logo Vcards" width="180"
                    style="max-width:180px; height:auto; display:block; margin:0 auto;">
                <p>Este es un correo automático, por favor no respondas directamente a este mensaje.</p>
            </div>
        </div>
    </body>

</html>