<?php

require_once __DIR__ . '/../models/Sesion.php';

class SesionService
{
    private $sesionModel;

    public function __construct($conexion)
    {
        $this->sesionModel = new Sesion($conexion);
    }

    public function guardarSesion(
        $usuarioId,
        $curso,
        $horario,
        $framework,
        $observaciones
    ) {
        if (empty($usuarioId)) {
            throw new Exception("Usuario no identificado.");
        }

        if (empty($curso)) {
            throw new Exception("Debe seleccionar un curso.");
        }

        if (empty($horario)) {
            throw new Exception("Debe seleccionar un horario.");
        }

        $cursosPermitidos = [
            'HTML',
            'CSS',
            'JavaScript',
            'Frameworks'
        ];

        if (!in_array($curso, $cursosPermitidos)) {
            throw new Exception("Curso no válido.");
        }

        return $this->sesionModel->guardar(
            $usuarioId,
            $curso,
            $horario,
            $framework,
            $observaciones
        );
    }
}