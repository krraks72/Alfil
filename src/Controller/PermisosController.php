<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Permisos Controller
 *
 * @property \App\Model\Table\PermisosTable $Permisos
 * @method \App\Model\Entity\Permiso[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PermisosController extends AppController
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

        if (!HelperController::verificarPermiso('Permisos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->paginate = ['contain' => ['Opciones', 'Perfiles'],];

        $filtroId = $this->request->getSession()->read('filtroId');
        
        $permiso = $this->Permisos->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $filtro = $this->request->getData('perfileId');
            $this->request->getSession()->write('filtroId', $filtro);
            return $this->redirect(['action' => 'index']);
        }

        if (!$filtroId) {
            $permisos = $this->paginate($this->Permisos->find()->where(['perfileId' => '']));
        }
        else {
            $permisos = $this->paginate($this->Permisos->find()->where(['perfileId' => $filtroId]));
            $this->request->getSession()->delete('filtroId');
        }
        
        $perfiles = $this->Permisos->Perfiles->find('list')->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('permiso', 'permisos', 'perfiles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Permisos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('permisoId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('permisoId');

        $permiso = $this->Permisos->get($id, ['contain' => ['Opciones', 'Perfiles']]);
        $this->set(compact('permiso', 'cachePermisos', 'permisosArray'));
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
        
        if (!HelperController::verificarPermiso('Permisos', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $permiso = $this->Permisos->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Validar si ya existe el permiso
            $existe = $this->Permisos->find()->where(['perfileId' => $data['perfileId'], 'opcioneId' => $data['opcioneId']])->count();

            if ($existe > 0) {
                $this->Flash->error(__('El permiso ya se encuentra incluido en el perfil, no se puede guardar un registro duplicado.'));
            } else {
                $permiso = $this->Permisos->patchEntity($permiso, $data);
                $permiso->usuarioCrea = HelperController::obtenerUsuario();

                if ($this->Permisos->save($permiso)) {
                    $this->Flash->success(__('El permiso ha sido creado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo crear el permiso. Inténtelo de nuevo.'));
            }
        }

        $opciones = $this->Permisos->Opciones->find('list', ['keyField' => 'id', 'valueField' => 'opcion', 'order' => ['opcion' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $perfiles = $this->Permisos->Perfiles->find('list', ['keyField' => 'id', 'valueField' => 'perfil', 'order' => ['perfil' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('permiso', 'opciones', 'perfiles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Permisos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('permisoId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $permiso = $this->Permisos->get($id, ['contain' => ['Opciones', 'Perfiles']]);
        $permiso->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $permiso = $this->Permisos->patchEntity($permiso, $this->request->getData());
            if ($this->Permisos->save($permiso)) {
                $this->Flash->success(__('El permiso ha sido guardado.'));
                $this->request->getSession()->delete('permisoId');
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el permiso. Inténtelo de nuevo.'));
        }

        $opciones = $this->Permisos->Opciones->find('list', ['keyField' => 'id', 'valueField' => 'opcion', 'order' => ['opcion' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $perfiles = $this->Permisos->Perfiles->find('list', ['keyField' => 'id', 'valueField' => 'perfil', 'order' => ['perfil' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('permiso', 'opciones', 'perfiles', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Permisos', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $permiso = $this->Permisos->get($id);
        if ($this->Permisos->delete($permiso)) {
            $this->Flash->success(__('El permiso ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el permiso. Inténtelo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Permisos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $permiso = $this->Permisos->get($id);
        $permiso->estado = 0; // Cambia el estado a inactivo
        $permiso->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Permisos->save($permiso)) {
            $this->Flash->success(__('El permiso ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el permiso. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    

    /**
     * Activar method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Permisos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $permiso = $this->Permisos->get($id);
        $permiso->estado = 1; // Cambia el estado a activo        
        $permiso->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Permisos->save($permiso)) {
            $this->Flash->success(__('El permiso ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el permiso. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerPermiso method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verPermiso($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('permisoId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarPermiso method
     *
     * @param string|null $id Permiso id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarPermiso($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('permisoId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
