<?php
/**
 * Script para instalar PHPMailer
 * Ejecuta este archivo en el navegador: http://localhost/ai-platform/install-phpmailer.php
 */

echo "<h1>Instalando PHPMailer...</h1>";

// Crear directorio vendor si no existe
if (!is_dir('vendor')) {
    mkdir('vendor', 0755, true);
}

// Descargar PHPMailer
$url = 'https://github.com/PHPMailer/PHPMailer/archive/refs/tags/v6.8.0.zip';
$zip_file = 'phpmailer.zip';

echo "<p>Descargando PHPMailer...</p>";

if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch);
    curl_close($ch);
    file_put_contents($zip_file, $data);
} else {
    file_put_contents($zip_file, file_get_contents($url));
}

echo "<p>Extrayendo archivos...</p>";

$zip = new ZipArchive;
if ($zip->open($zip_file) === TRUE) {
    $zip->extractTo('.');
    $zip->close();
    unlink($zip_file);
    
    // Mover archivos a vendor
    if (is_dir('PHPMailer-6.8.0/src')) {
        if (!is_dir('vendor/phpmailer')) {
            mkdir('vendor/phpmailer', 0755, true);
        }
        
        $files = scandir('PHPMailer-6.8.0/src');
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                copy('PHPMailer-6.8.0/src/' . $file, 'vendor/phpmailer/' . $file);
            }
        }
        
        // Limpiar
        array_map('unlink', glob('PHPMailer-6.8.0/src/*'));
        rmdir('PHPMailer-6.8.0/src');
        rmdir('PHPMailer-6.8.0');
    }
    
    echo "<p style='color: green;'><strong>✓ PHPMailer instalado correctamente!</strong></p>";
    echo "<p>Ahora configura tu contraseña de Gmail en api/send-email.php</p>";
} else {
    echo "<p style='color: red;'><strong>Error al extraer PHPMailer</strong></p>";
}
?>
