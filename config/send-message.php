<?php
// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración del destinatario del correo
    $to = "pereyra.damian89@gmail.com"; 

    // Recoger y sanitizar los datos del formulario
    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = htmlspecialchars(trim($_POST["mensaje"]));

    // Validación de datos
    if (empty($nombre) || empty($email) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, completa todos los campos correctamente.";
        exit;
    }

    // Asunto del correo
    $subject = "Nuevo mensaje de contacto de $nombre";

    // Cuerpo del correo
    $email_content = "Nombre: $nombre\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$mensaje\n";

    // Cabeceras del correo
    $headers = "From: $nombre <$email>";

    // Enviar el correo
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Gracias, tu mensaje ha sido enviado correctamente.";
    } else {
        echo "Lo sentimos, hubo un problema al enviar tu mensaje. Inténtalo de nuevo más tarde.";
    }
} else {
    // Si se intenta acceder al archivo sin enviar el formulario, redirigir al usuario
    header("Location: contact.html");
    exit;
}
?>
