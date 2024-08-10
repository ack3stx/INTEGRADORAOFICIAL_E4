<?php
// La contraseña que deseas hashear
$password = '1234';

// Generar el hash de la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Mostrar la contraseña hasheada
echo "Contraseña hasheada: " . $hashed_password;
?>