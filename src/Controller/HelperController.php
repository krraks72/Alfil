<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Utility\Security;

class HelperController extends AppController
{
    // Organizar permisos en un array
    public static function obtenerPermisosUsuario(): array
    {
        $session = $_SESSION;
        $usuarioId = $session['Auth']->id ?? null;

        if (!$usuarioId) {
            return [];
        }

        $cacheKey = "permisos_usuario_{$usuarioId}";
        $cachePermisos = Cache::read($cacheKey, 'long') ?? [];

        $permisosArray = [];
        foreach ($cachePermisos as $permisoCrud) {
            $permisosArray[$permisoCrud['opcion']] = [
                'leer' => (bool)$permisoCrud['leer'],
                'editar' => (bool)$permisoCrud['editar'],
                'crear' => (bool)$permisoCrud['crear'],
                'eliminar' => (bool)$permisoCrud['eliminar'],
            ];
        }

        return $permisosArray;
    }

    // Obtener cache "permisos_usuario_"
    public static function obtenerCacheUsuario(): array
    {
        $session = $_SESSION;
        $usuarioId = $session['Auth']->id ?? null;

        if (!$usuarioId) {
            return [];
        }

        $cacheKey = "permisos_usuario_{$usuarioId}";
        $cachePermisos = Cache::read($cacheKey, 'long') ?? [];

        return $cachePermisos;
    }

    // Obtener documento del usuario "usuarioDocumento"
    public static function obtenerAutenticacionUsuario(): string
    {
        $session = $_SESSION;
        $usuarioDocumento = $session['Auth']->documento ?? null;

        if (!$usuarioDocumento) {
            return '';
        }

        return $usuarioDocumento;
    }

    // Obtener nombre del usuario "usuario"
    public static function obtenerUsuario(): string
    {
        $session = $_SESSION;
        $usuario = $session['Auth']->usuario ?? null;

        if (!$usuario) {
            return '';
        }

        return $usuario;
    }

    // Verificar permisos para controlador y acción
    public static function verificarPermiso(string $controller, string $accion): bool
    {
        $permisosArray = self::obtenerPermisosUsuario();
        return !empty($permisosArray[$controller][$accion]);
    }

    // Organizar permisos en un array con clave -> permisos
    public static function obtenerArrayPermiso(): array
    {   
        $cachePermisos = HelperController::obtenerCacheUsuario();
        $permisosArray = [];
        if (!empty($cachePermisos)) {
            foreach ($cachePermisos as $permiso) {
                $modulo = $permiso['modulo'];
                $opcion = $permiso['opcion'];
                $etiqueta = $permiso['etiqueta'];

                $permisosArray[$modulo][$opcion] = [
                    'leer' => (bool)$permiso['leer'],
                    'editar' => (bool)$permiso['editar'],
                    'crear' => (bool)$permiso['crear'],
                    'eliminar' => (bool)$permiso['eliminar'],
                    'etiqueta' => $etiqueta,
                ];
            }
        }

        return $permisosArray;
    }
}
