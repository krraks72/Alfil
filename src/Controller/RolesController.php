<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
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

        if (!HelperController::verificarPermiso('Roles', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('roleId');

        $this->paginate = ['contain' => ['Perfiles', 'Users'],];

        $roles = $this->paginate($this->Roles);
        $this->set(compact('roles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Roles', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('roleId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('roleId');

        $role = $this->Roles->get($id, ['contain' => ['Perfiles', 'Users'],]);
        $this->set(compact('role', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Roles', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $role->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('El rol ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el rol. Inténtelo de nuevo.'));
        }
        $perfiles = $this->Roles->Perfiles->find('list', ['keyField' => 'id', 'valueField' => 'perfil', 'order' => ['perfil' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('role', 'perfiles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Roles', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('roleId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $role = $this->Roles->get($id, ['contain' => ['Perfiles', 'Users'],]);
        $role->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('El rol ha sido guardado.'));
                $this->request->getSession()->delete('roleId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el rol. Inténtelo de nuevo.'));
        }
        $perfiles = $this->Roles->Perfiles->find('list', ['keyField' => 'id', 'valueField' => 'perfil', 'order' => ['perfil' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('role', 'perfiles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Roles', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('El rol ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el rol. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Roles', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $role = $this->Roles->get($id);
        $role->estado = 0; // Cambia el estado a inactivo
        $role->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Roles->save($role)) {
            $this->Flash->success(__('El rol ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el rol. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Roles', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $role = $this->Roles->get($id);
        $role->estado = 1; // Cambia el estado a activo
        $role->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Roles->save($role)) {
            $this->Flash->success(__('El rol ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el rol. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerRole method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verRole($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('roleId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarRole method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarRole($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('roleId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
