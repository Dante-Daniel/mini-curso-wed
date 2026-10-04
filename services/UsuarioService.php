<?php

require_once __DIR__ . '/../models/Usuario.php';

class UsuarioService
{
    private $usuarioModel;

    public function __construct($conexion)
    {
        $this->usuarioModel = new Usuario($conexion);
    }

    public function registrarUsuario(
        $nombre,
        $celular,
        $correo,
        $clave,
        $profesor
    ) {
        if (
            empty($nombre) ||
            empty($celular) ||
            empty($correo) ||
            empty($clave) ||
            empty($profesor)
        ) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El correo electrónico no es válido.");
        }

        if (!preg_match('/^[0-9]{5}$/', $clave)) {
            throw new Exception("La clave debe tener exactamente 5 dígitos.");
        }

        $claveEncriptada = password_hash(
            $clave,
            PASSWORD_DEFAULT
        );

        return $this->usuarioModel->registrar(
            $nombre,
            $celular,
            $correo,
            $claveEncriptada,
            $profesor
        );
    }

    public function obtenerUsuario($id)
    {
        return $this->usuarioModel->buscarPorId($id);
    }
}