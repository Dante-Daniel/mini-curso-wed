<?php

session_start();

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../services/UsuarioService.php';

$service = new UsuarioService($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $nombre = trim($_POST['nombre']);
        $celular = trim($_POST['celular']);
        $correo = trim($_POST['correo']);
        $clave = trim($_POST['clave']);
        $profesor = trim($_POST['profesor']);

        $usuarioId = $service->registrarUsuario(
            $nombre,
            $celular,
            $correo,
            $clave,
            $profesor
        );

        $_SESSION['usuario_id'] = $usuarioId;

        header("Location: ../sesiones.php");
        exit;

    } catch (Exception $e) {

        $_SESSION['error'] = $e->getMessage();

        header("Location: ../index.php");
        exit;
    }
}