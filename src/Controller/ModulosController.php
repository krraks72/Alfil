<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Modulos Controller
 *
 * @property \App\Model\Table\ModulosTable $Modulos
 * @method \App\Model\Entity\Modulo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModulosController extends AppController
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

        if (!HelperController::verificarPermiso('Modulos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $modulos = $this->paginate($this->Modulos);
        $this->set(compact('modulos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Modulos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('moduloId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('moduloId');

        $modulo = $this->Modulos->get($id, ['contain' => ['Opciones'],]);

        $this->set(compact('modulo', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Modulos', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $modulo = $this->Modulos->newEmptyEntity();
        if ($this->request->is('post')) {
            $modulo = $this->Modulos->patchEntity($modulo, $this->request->getData());
            $modulo->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Modulos->save($modulo)) {
                $this->Flash->success(__('El módulo ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el módulo. Inténtelo de nuevo.'));
        }
        
        $this->set(compact('modulo', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Modulos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('moduloId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $modulo = $this->Modulos->get($id, ['contain' => ['Opciones'],]);
        $modulo->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $modulo = $this->Modulos->patchEntity($modulo, $this->request->getData());
            if ($this->Modulos->save($modulo)) {
                $this->Flash->success(__('El módulo ha sido guardado.'));
                $this->request->getSession()->delete('moduloId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el módulo. Inténtelo de nuevo.'));
        }

        $this->set(compact('modulo', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Modulos', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $modulo = $this->Modulos->get($id);
        if ($this->Modulos->delete($modulo)) {
            $this->Flash->success(__('El módulo ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el módulo. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Modulos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $modulo = $this->Modulos->get($id);
        $modulo->estado = 0; // Cambia el estado a inactivo
        $modulo->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Modulos->save($modulo)) {
            $this->Flash->success(__('El módulo ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el módulo. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Modulos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $modulo = $this->Modulos->get($id);
        $modulo->estado = 1; // Cambia el estado a activo
        $modulo->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Modulos->save($modulo)) {
            $this->Flash->success(__('El módulo ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el módulo. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerModulo method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verModulo($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('moduloId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarModulo method
     *
     * @param string|null $id Modulo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarModulo($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('moduloId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
