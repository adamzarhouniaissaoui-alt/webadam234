<?php
/**
 * Archivo de prueba para verificar que el envío de emails funciona
 * Accede a: http://localhost/ai-platform/test-email.php
 */

require_once 'api/send-email.php';

$test_email = 'adam.zarhouni.aissaoui@ieselcalamot.com';
$test_subject = 'Prueba de Email - AI Platform';
$test_body = '
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #6366f1; color: white; padding: 20px; border-radius: 8px 8px 0 0; text-align: center; }
        .content { background: white; padding: 20px; border-radius: 0 0 8px 8px; }
        .success { color: #10b981; font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>¡Prueba de Email Exitosa!</h2>
        </div>
        <div class="content">
            <p class="success">✓ El sistema de emails está funcionando correctamente.</p>
            <p>Este es un email de prueba enviado desde tu plataforma AI.</p>
            <p>Si recibes este email, significa que:</p>
            <ul>
                <li>La función mail() de PHP está configurada correctamente</li>
                <li>El servidor XAMPP está enviando emails</li>
                <li>Los formularios de contacto funcionarán correctamente</li>
            </ul>
            <p><strong>Fecha de envío:</strong> ' . date('Y-m-d H:i:s') . '</p>
        </div>
    </div>
</body>
</html>';

$result = sendEmail($test_email, $test_subject, $test_body);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Email - AI Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .status {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .method {
            font-weight: bold;
            color: #667eea;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
            width: 100%;
            box-sizing: border-box;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background: #764ba2;
        }
        .info ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .info li {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Prueba de Sistema de Emails</h1>
        
        <?php if ($result['success']): ?>
            <div class="status success">
                ✓ <strong>¡Email procesado correctamente!</strong>
                <p>Método: <span class="method"><?php echo $result['method']; ?></span></p>
                <p>Se ha procesado un email de prueba para: <strong><?php echo $test_email; ?></strong></p>
            </div>
            
            <div class="info">
                <strong>¿Qué significa esto?</strong>
                <ul>
                    <li>El sistema de emails está funcionando</li>
                    <li>Los emails se están guardando en la carpeta /emails</li>
                    <li>Los formularios de contacto enviarán emails correctamente</li>
                    <li>Puedes ver los emails guardados en: <a href="admin/view-messages.php">Panel de Administración</a></li>
                </ul>
            </div>
        <?php else: ?>
            <div class="status error">
                ✗ <strong>Error al procesar el email</strong>
                <p><?php echo $result['error'] ?? 'Error desconocido'; ?></p>
            </div>
        <?php endif; ?>
        
        <a href="index.html" class="button">Volver a la página principal</a>
    </div>
</body>
</html>
