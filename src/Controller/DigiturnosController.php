<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Digiturnos Controller
 *
 */
class DigiturnosController extends AppController
{
    public function index()
    {
        $permisosArray = [];
        
        if ($this->request->is('post')) {
            $documento = $this->request->getData('documento');

            // Aquí puedes hacer lo que necesites con el documento, por ejemplo:
            $this->Flash->success("Documento recibido: $documento");

            // Redirige o procesa según necesidad
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('permisosArray'));
        // Solo renderiza la vista
    }
}
