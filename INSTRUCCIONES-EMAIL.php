<?php
/**
 * INSTRUCCIONES PARA CONFIGURAR EL ENVÍO DE EMAILS EN XAMPP
 * 
 * Este archivo contiene las instrucciones paso a paso para que funcione
 * el envío de emails desde tu formulario de contacto.
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrucciones de Configuración de Emails</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #667eea;
            margin-bottom: 30px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        .step {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
            border-radius: 4px;
        }
        .step-number {
            display: inline-block;
            background: #667eea;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            margin-right: 10px;
        }
        .code {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .warning {
            background: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px 5px 10px 0;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background: #764ba2;
        }
        .button-secondary {
            background: #6c757d;
        }
        .button-secondary:hover {
            background: #5a6268;
        }
        ul {
            margin-left: 20px;
            line-height: 1.8;
        }
        li {
            margin: 10px 0;
        }
        .highlight {
            background: #fff3cd;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📧 Configuración de Envío de Emails en XAMPP</h1>
        
        <div class="warning">
            <strong>⚠️ Importante:</strong> Sigue estos pasos en orden para que el envío de emails funcione correctamente.
        </div>

        <h2>Paso 1: Instalar PHPMailer</h2>
        <div class="step">
            <span class="step-number">1</span>
            <strong>Abre en tu navegador:</strong>
            <div class="code">http://localhost/ai-platform/install-phpmailer.php</div>
            <p>Espera a que se complete la instalación. Verás un mensaje de confirmación.</p>
        </div>

        <h2>Paso 2: Configurar tu Contraseña de Gmail</h2>
        <div class="step">
            <span class="step-number">2</span>
            <strong>Genera una contraseña de aplicación en Gmail:</strong>
            <ul>
                <li>Ve a: <a href="https://myaccount.google.com/apppasswords" target="_blank">https://myaccount.google.com/apppasswords</a></li>
                <li>Selecciona <span class="highlight">Mail</span> como aplicación</li>
                <li>Selecciona <span class="highlight">Windows Computer</span> como dispositivo</li>
                <li>Gmail te generará una contraseña de 16 caracteres</li>
                <li>Cópiala (sin espacios)</li>
            </ul>
        </div>

        <h2>Paso 3: Actualizar la Contraseña en el Código</h2>
        <div class="step">
            <span class="step-number">3</span>
            <strong>Edita el archivo <span class="highlight">api/send-email.php</span>:</strong>
            <ul>
                <li>Busca esta línea:
                    <div class="code">$mail->Password = 'ygvjksxlzcvbmnop';</div>
                </li>
                <li>Reemplaza <span class="highlight">'ygvjksxlzcvbmnop'</span> con tu contraseña de 16 caracteres (sin espacios)</li>
                <li>Guarda el archivo</li>
            </ul>
        </div>

        <h2>Paso 4: Prueba el Sistema de Emails</h2>
        <div class="step">
            <span class="step-number">4</span>
            <strong>Abre en tu navegador:</strong>
            <div class="code">http://localhost/ai-platform/test-email.php</div>
            <p>Si ves un mensaje verde que dice "¡Email procesado correctamente!", significa que todo está funcionando.</p>
        </div>

        <h2>Paso 5: Prueba el Formulario de Contacto</h2>
        <div class="step">
            <span class="step-number">5</span>
            <strong>Ahora prueba el formulario de contacto:</strong>
            <ul>
                <li>Ve a: <a href="index.html#contacto">http://localhost/ai-platform/index.html#contacto</a></li>
                <li>Rellena el formulario con tus datos</li>
                <li>Haz clic en "Enviar Mensaje"</li>
                <li>Deberías recibir un email en <span class="highlight">adam.zarhouni.aissaoui@ieselcalamot.com</span></li>
            </ul>
        </div>

        <h2>Ver Mensajes Recibidos</h2>
        <div class="step">
            <strong>Panel de Administración:</strong>
            <p>Puedes ver todos los mensajes de contacto recibidos en:</p>
            <div class="code">http://localhost/ai-platform/admin/view-messages.php</div>
        </div>

        <h2>Solución de Problemas</h2>
        <div class="step">
            <strong>Si no recibes los emails:</strong>
            <ul>
                <li><strong>Verifica la contraseña:</strong> Asegúrate de que copiaste correctamente la contraseña de 16 caracteres sin espacios</li>
                <li><strong>Revisa la carpeta de spam:</strong> Los emails pueden ir a la carpeta de spam de Gmail</li>
                <li><strong>Verifica la conexión a internet:</strong> XAMPP necesita conexión a internet para conectarse a Gmail SMTP</li>
                <li><strong>Revisa los logs:</strong> Los emails se guardan en la carpeta <span class="highlight">/emails</span> como respaldo</li>
                <li><strong>Habilita aplicaciones menos seguras:</strong> Si tienes autenticación de dos factores, necesitas usar una contraseña de aplicación (que ya hiciste)</li>
            </ul>
        </div>

        <div class="success">
            <strong>✓ ¡Listo!</strong> Una vez completados estos pasos, el envío de emails funcionará correctamente en tu página web.
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="index.html" class="button">Volver a la página principal</a>
            <a href="test-email.php" class="button button-secondary">Probar sistema de emails</a>
            <a href="admin/view-messages.php" class="button button-secondary">Ver mensajes</a>
        </div>
    </div>
</body>
</html>
