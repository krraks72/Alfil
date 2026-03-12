<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Opciones Controller
 *
 * @property \App\Model\Table\OpcionesTable $Opciones
 * @method \App\Model\Entity\Opcione[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpcionesController extends AppController
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

        if (!HelperController::verificarPermiso('Opciones', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('opcioneId');

        $this->paginate = ['contain' => ['Modulos', 'Permisos'],];

        $opciones = $this->paginate($this->Opciones);
        $this->set(compact('opciones', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Opciones', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('opcioneId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('opcioneId');

        $opcione = $this->Opciones->get($id, ['contain' => ['Modulos', 'Permisos'],]);
        $this->set(compact('opcione', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Opciones', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $opcione = $this->Opciones->newEmptyEntity();
        if ($this->request->is('post')) {
            $opcione = $this->Opciones->patchEntity($opcione, $this->request->getData());
            $opcione->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Opciones->save($opcione)) {
                $this->Flash->success(__('La opción ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la opción. Inténtelo de nuevo.'));
        }
        
        $modulos = $this->Opciones->Modulos->find('list', ['keyField' => 'id', 'valueField' => 'modulo', 'order' => ['modulo' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
         
        $this->set(compact('opcione', 'modulos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Opciones', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('opcioneId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $opcione = $this->Opciones->get($id, ['contain' => ['Modulos', 'Permisos'],]);
        $opcione->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $opcione = $this->Opciones->patchEntity($opcione, $this->request->getData());
            if ($this->Opciones->save($opcione)) {
                $this->Flash->success(__('La opción ha sido guardada.'));
                $this->request->getSession()->delete('opcioneId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la opción. Inténtelo de nuevo.'));
        }

        $modulos = $this->Opciones->Modulos->find('list', ['keyField' => 'id', 'valueField' => 'modulo', 'order' => ['modulo' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('opcione', 'modulos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Opciones', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $opcione = $this->Opciones->get($id);
        if ($this->Opciones->delete($opcione)) {
            $this->Flash->success(__('La opción ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la opción. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Opciones', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $opcione = $this->Opciones->get($id);
        $opcione->estado = 0; // Cambia el estado a inactivo
        $opcione->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Opciones->save($opcione)) {
            $this->Flash->success(__('La opción ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la opción. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Opciones', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $opcione = $this->Opciones->get($id);
        $opcione->estado = 1; // Cambia el estado a activo
        $opcione->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Opciones->save($opcione)) {
            $this->Flash->success(__('La opción ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la opción. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerOpcione method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verOpcione($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('opcioneId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarOpcione method
     *
     * @param string|null $id Opcione id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarOpcione($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('opcioneId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
