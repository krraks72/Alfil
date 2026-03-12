<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Datasource\ConnectionManager;

class HomeController extends AppController
{
    public function index()
    {
        $session = $_SESSION;
        $home = $session['Auth']->nombre;
        $usuarioId = $session['Auth']->id;

        $cacheKey = "permisos_usuario_{$usuarioId}";

        $cachePermisos = Cache::read($cacheKey, 'long');

        if ($cachePermisos === null) {
            $conn = ConnectionManager::get('default');
            $stmt = $conn->execute("EXEC dbo.qry_Permisos @usuarioId = :usuarioId", ['usuarioId' => $usuarioId]);
            $cachePermisos = $stmt->fetchAll('assoc');

            Cache::write($cacheKey, $cachePermisos, 'long');
        }

        $permisosUsuarios = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso();

        // Enviar datos a la vista
        $this->set(compact('home', 'permisosUsuarios', 'permisosArray'));
    }
}
