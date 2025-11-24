<?php
/**
 * Nombre del archivo: procesar_resena.php
 * Ubicación: Debe estar en el mismo directorio que formulario.html
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recoger y sanitizar los datos
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $correo_usuario = htmlspecialchars(trim($_POST['correo']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // 2. Configuración de direcciones
    // ¡REEMPLAZA ESTA DIRECCIÓN CON TU CORREO REAL!
    $correo_destino = "tu.correo.destino@ejemplo.com"; 
    $sitio_web = "Tu Nombre de Sitio Web";
    $remitente_sitio = "no-responder@" . strtolower(str_replace(' ', '', $sitio_web)) . ".com"; // Ejemplo: no-responder@tusitioweb.com

    // --- PARTE A: Correo para ti (La Reseña) ---

    $asunto_destino = "📩 Nueva Reseña de: " . $nombre;
    $cuerpo_destino = "Nombre: " . $nombre . "\nEmail: " . $correo_usuario . "\nMensaje:\n" . $mensaje;
    
    // Configura las cabeceras para que puedas responder directamente al usuario
    $cabeceras_destino = "From: " . $nombre . " <" . $correo_usuario . ">" . "\r\n";
    $cabeceras_destino .= "Reply-To: " . $correo_usuario . "\r\n";
    $cabeceras_destino .= "Content-type: text/plain; charset=utf-8";

    // Envío de la reseña a la dirección de destino
    mail($correo_destino, $asunto_destino, $cuerpo_destino, $cabeceras_destino);
    
    // --- PARTE B: Correo de Agradecimiento Automático para el Usuario ---

    $asunto_agradecimiento = "Hola, gracias por tus comentarios";
    $cuerpo_agradecimiento = "Hola " . $nombre . ",\n\n";
    $cuerpo_agradecimiento .= "¡Gracias por tus comentarios! Tu opinión es muy importante para nosotros.\n\n";
    $cuerpo_agradecimiento .= "Saludos cordiales,\nEl Equipo de " . $sitio_web;
    
    // Cabeceras para el correo de agradecimiento
    $cabeceras_agradecimiento = "From: " . $sitio_web . " <" . $remitente_sitio . ">" . "\r\n";
    $cabeceras_agradecimiento .= "Content-type: text/plain; charset=utf-8";

    // Envío del correo de agradecimiento al usuario
    mail($correo_usuario, $asunto_agradecimiento, $cuerpo_agradecimiento, $cabeceras_agradecimiento);
    
    // 3. Redirigir al usuario
    // Necesitas crear un archivo simple llamado 'gracias.html'
    header("Location: gracias.html");
    exit;

} else {
    // Redirigir si se accede al PHP sin enviar el formulario
    header("Location: formulario.html");
    exit;
}
?>