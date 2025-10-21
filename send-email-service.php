<?php
/**
 * Servicio de envío de emails para XAMPP
 * Este archivo puede ser ejecutado manualmente o por un cron job
 * para enviar emails almacenados en la carpeta de mensajes
 */

require_once 'config.php';

// Función para enviar emails usando PHPMailer (alternativa a mail())
function sendEmailWithPHPMailer($to, $subject, $body, $from = 'noreply@aiplatform.local') {
    // Si tienes PHPMailer instalado, descomenta esto:
    // require 'vendor/autoload.php';
    // $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    // ... configuración de PHPMailer ...
    
    // Por ahora, usamos mail() de PHP
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: " . $from . "\r\n";
    
    return mail($to, $subject, $body, $headers);
}

// Función para procesar mensajes pendientes
function processPendingMessages() {
    $messages_dir = 'messages';
    
    if (!is_dir($messages_dir)) {
        return ['success' => false, 'message' => 'No hay mensajes pendientes'];
    }
    
    $files = glob($messages_dir . '/message_*.txt');
    $processed = 0;
    
    foreach ($files as $file) {
        $content = file_get_contents($file);
        
        // Enviar email
        $to = ADMIN_EMAIL;
        $subject = "Nuevo mensaje de contacto desde AI Platform";
        
        if (sendEmailWithPHPMailer($to, $subject, $content)) {
            unlink($file); // Eliminar archivo después de enviar
            $processed++;
        }
    }
    
    return ['success' => true, 'message' => "Se procesaron $processed mensajes"];
}

// Si se accede directamente, procesar mensajes
if (php_sapi_name() === 'cli' || $_GET['action'] === 'process') {
    $result = processPendingMessages();
    echo json_encode($result);
}
?>
