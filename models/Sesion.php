<?php

class Sesion
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function guardar(
        $usuarioId,
        $curso,
        $horario,
        $framework,
        $observaciones
    ) {
        $sql = "INSERT INTO sesiones
                (usuario_id, curso, horario, framework, observaciones)
                VALUES
                (:usuario_id, :curso, :horario, :framework, :observaciones)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':curso' => $curso,
            ':horario' => $horario,
            ':framework' => $framework,
            ':observaciones' => $observaciones
        ]);

        return true;
    }
}