<?php

class Usuario
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function registrar(
        $nombre,
        $celular,
        $correo,
        $clave,
        $profesor
    ) {
        $sql = "INSERT INTO usuarios
                (nombre, celular, correo, clave, profesor)
                VALUES
                (:nombre, :celular, :correo, :clave, :profesor)";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':nombre' => $nombre,
            ':celular' => $celular,
            ':correo' => $correo,
            ':clave' => $clave,
            ':profesor' => $profesor
        ]);

        return $this->conexion->lastInsertId();
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT id, nombre, celular, correo, profesor
                FROM usuarios
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}