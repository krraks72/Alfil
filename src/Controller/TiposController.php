<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tipos Controller
 *
 * @property \App\Model\Table\TiposTable $Tipos
 * @method \App\Model\Entity\Tipo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TiposController extends AppController
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

        if (!HelperController::verificarPermiso('Tipos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('tipoId');

        $tipos = $this->paginate($this->Tipos);
        $this->set(compact('tipos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Tipos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('tipoId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('tipoId');

        $tipo = $this->Tipos->get($id, ['contain' => [],]);
        $this->set(compact('tipo', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Tipos', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $tipo = $this->Tipos->newEmptyEntity();
        if ($this->request->is('post')) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->getData());
            $tipo->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__('El tipo de documento ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el tipo de documento. Inténtelo de nuevo.'));
        }
        $this->set(compact('tipo', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Tipos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('tipoId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $tipo = $this->Tipos->get($id, ['contain' => [],]);
        $tipo->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipo = $this->Tipos->patchEntity($tipo, $this->request->getData());
            if ($this->Tipos->save($tipo)) {
                $this->Flash->success(__('El tipo de documento ha sido guardado.'));
                $this->request->getSession()->delete('tipoId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el tipo de documento. Inténtelo de nuevo.'));
        }
        $this->set(compact('tipo', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Tipos', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $tipo = $this->Tipos->get($id);
        if ($this->Tipos->delete($tipo)) {
            $this->Flash->success(__('El tipo de documento ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el tipo de documento. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Tipos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $tipo = $this->Tipos->get($id);
        $tipo->estado = 0; // Cambia el estado a inactivo
        $tipo->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Tipos->save($tipo)) {
            $this->Flash->success(__('El tipo de documento ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el tipo de documento. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Tipos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $tipo = $this->Tipos->get($id);
        $tipo->estado = 1; // Cambia el estado a activo
        $tipo->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Tipos->save($tipo)) {
            $this->Flash->success(__('El tipo de documento ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el tipo de documento. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerTipo method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verTipo($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('tipoId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarTipo method
     *
     * @param string|null $id Tipo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarTipo($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('tipoId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
