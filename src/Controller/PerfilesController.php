<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Perfiles Controller
 *
 * @property \App\Model\Table\PerfilesTable $Perfiles
 * @method \App\Model\Entity\Perfile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PerfilesController extends AppController
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

        if (!HelperController::verificarPermiso('Perfiles', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('perfileId');

        $perfiles = $this->paginate($this->Perfiles);
        $this->set(compact('perfiles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Perfiles', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('perfileId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('perfileId');

        $perfile = $this->Perfiles->get($id, ['contain' => ['Roles', 'Permisos'],]);

        $this->set(compact('perfile', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Perfiles', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $perfile = $this->Perfiles->newEmptyEntity();
        if ($this->request->is('post')) {
            $perfile = $this->Perfiles->patchEntity($perfile, $this->request->getData());
            $perfile->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Perfiles->save($perfile)) {
                $this->Flash->success(__('El perfil ha sido guardado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el perfil. Inténtelo de nuevo.'));
        }

        $this->set(compact('perfile', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Permisos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('perfileId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $perfile = $this->Perfiles->get($id, ['contain' => ['Roles', 'Permisos'],]);
        $perfile->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $perfile = $this->Perfiles->patchEntity($perfile, $this->request->getData());
            if ($this->Perfiles->save($perfile)) {
                $this->Flash->success(__('El perfil ha sido guardado.'));
                $this->request->getSession()->delete('perfileId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar el perfil. Inténtelo de nuevo.'));
        }
        
        $this->set(compact('perfile', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Permisos', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $perfile = $this->Perfiles->get($id);
        if ($this->Perfiles->delete($perfile)) {
            $this->Flash->success(__('El perfil ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminado el perfil. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Perfiles', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $perfile = $this->Perfiles->get($id);
        $perfile->estado = 0; // Cambia el estado a inactivo
        $perfile->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Perfiles->save($perfile)) {
            $this->Flash->success(__('El perfil ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el perfil. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Perfiles', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $perfile = $this->Perfiles->get($id);
        $perfile->estado = 1; // Cambia el estado a activo
        $perfile->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Perfiles->save($perfile)) {
            $this->Flash->success(__('El perfil ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el perfil. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerPerfile method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verPerfile($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('perfileId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarPerfile method
     *
     * @param string|null $id Perfile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarPerfile($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('perfileId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
