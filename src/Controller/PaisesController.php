<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Paises Controller
 *
 * @property \App\Model\Table\PaisesTable $Paises
 * @method \App\Model\Entity\Paise[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaisesController extends AppController
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

        if (!HelperController::verificarPermiso('Paises', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('paiseId');

        $paises = $this->paginate($this->Paises);
        
        $this->set(compact('paises', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Paises', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('paiseId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('paiseId');

        $paise = $this->Paises->get($id, ['contain' => ['Departamentos'],]);

        $this->set(compact('paise', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Paises', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $paise = $this->Paises->newEmptyEntity();
        if ($this->request->is('post')) {
            $paise = $this->Paises->patchEntity($paise, $this->request->getData());
            $paise->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Paises->save($paise)) {
                $this->Flash->success(__('El país ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el país. Inténtelo de nuevo.'));
        }
        $this->set(compact('paise', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Paises', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('paiseId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $paise = $this->Paises->get($id, ['contain' => ['Departamentos'],]);
        $paise->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $paise = $this->Paises->patchEntity($paise, $this->request->getData());
            if ($this->Paises->save($paise)) {
                $this->Flash->success(__('El país ha sido guardado.'));
                $this->request->getSession()->delete('paiseId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el país. Inténtelo de nuevo.'));
        }
        $this->set(compact('paise', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Paises', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $paise = $this->Paises->get($id);
        if ($this->Paises->delete($paise)) {
            $this->Flash->success(__('El país ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminado el país. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Paises', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $paise = $this->Paises->get($id);
        $paise->estado = 0; // Cambia el estado a inactivo
        $paise->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Paises->save($paise)) {
            $this->Flash->success(__('El país ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el país. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */     
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Paises', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $paise = $this->Paises->get($id);
        $paise->estado = 1; // Cambia el estado a activo
        $paise ->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Paises->save($paise)) {
            $this->Flash->success(__('El país ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el país. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerPaise method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function verPaise($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('paiseId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarPaise method
     *
     * @param string|null $id Paise id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarPaise($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('paiseId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
