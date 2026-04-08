<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Rutas Controller
 *
 * @property \App\Model\Table\RutasTable $Rutas
 * @method \App\Model\Entity\Ruta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RutasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Rutas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('rutaId');

        $rutas = $this->paginate($this->Rutas);

        $this->set(compact('rutas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Rutas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('rutaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('rutaId');

        $ruta = $this->Rutas->get($id, ['contain' => [],]);

        $this->set(compact('ruta', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Rutas', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $ruta = $this->Rutas->newEmptyEntity();
        if ($this->request->is('post')) {
            $ruta = $this->Rutas->patchEntity($ruta, $this->request->getData());
            $ruta->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Rutas->save($ruta)) {
                $this->Flash->success(__('La ruta ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la ruta. Inténtelo de nuevo.'));
        }
        $this->set(compact('ruta', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Rutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('rutaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $ruta = $this->Rutas->get($id, ['contain' => [],]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ruta = $this->Rutas->patchEntity($ruta, $this->request->getData());
            if ($this->Rutas->save($ruta)) {
                $this->Flash->success(__('La ruta ha sido guardada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la ruta. Inténtelo de nuevo.'));
        }
        $this->set(compact('ruta', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Rutas', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $ruta = $this->Rutas->get($id);
        if ($this->Rutas->delete($ruta)) {
            $this->Flash->success(__('La ruta ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo guardar la ruta. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Rutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $ruta = $this->Rutas->get($id);
        $ruta->estado = 0; // Cambia el estado a inactivo
        $ruta->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Rutas->save($ruta)) {
            $this->Flash->success(__('La ruta ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la ruta. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */     
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Rutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $ruta = $this->Rutas->get($id);
        $ruta->estado = 1; // Cambia el estado a activo
        $ruta ->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Rutas->save($ruta)) {
            $this->Flash->success(__('La ruta ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar la ruta. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerRuta method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function verRuta($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('rutaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarRuta method
     *
     * @param string|null $id Ruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarRuta($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('rutaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
