<?php

session_start();

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../services/SesionService.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$service = new SesionService($conexion);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {

        $usuarioId = $_SESSION['usuario_id'];

        $curso = trim($_POST['curso']);
        $horario = trim($_POST['horario']);
        $framework = isset($_POST['framework'])
            ? trim($_POST['framework'])
            : null;

        $observaciones = trim(
            $_POST['observaciones'] ?? ''
        );

        $service->guardarSesion(
            $usuarioId,
            $curso,
            $horario,
            $framework,
            $observaciones
        );

        $_SESSION['mensaje'] =
            "La sesión de $curso se guardó correctamente.";

    } catch (Exception $e) {

        $_SESSION['error'] = $e->getMessage();
    }

    header("Location: ../sesiones.php");
    exit;
}