<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Departamentos Controller
 *
 * @property \App\Model\Table\DepartamentosTable $Departamentos
 * @method \App\Model\Entity\Departamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepartamentosController extends AppController
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

        if (!HelperController::verificarPermiso('Departamentos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->getSession()->delete('departamentoId');

        $this->paginate = ['contain' => ['Paises'],];

        $departamentos = $this->paginate($this->Departamentos);
        $this->set(compact('departamentos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso();

        if (!HelperController::verificarPermiso('Departamentos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('departamentoId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->request->getSession()->delete('departamentoId');
        
        $departamento = $this->Departamentos->get($id, ['contain' => ['Paises'],]);
        
        $this->set(compact('departamento', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Departamentos', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $departamento = $this->Departamentos->newEmptyEntity();
        if ($this->request->is('post')) {
            $departamento = $this->Departamentos->patchEntity($departamento, $this->request->getData());
            $departamento->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Departamentos->save($departamento)) {
                $this->Flash->success(__('El departamento ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el departamento. Inténtelo de nuevo.'));
        }

        $paises = $this->Departamentos->Paises->find('list', ['keyField' => 'id', 'valueField' => 'pais', 'order' => ['pais' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $this->set(compact('departamento', 'paises', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso();

        if (!HelperController::verificarPermiso('Departamentos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('departamentoId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $departamento = $this->Departamentos->get($id, ['contain' => ['Paises'],]);
        $departamento->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $departamento = $this->Departamentos->patchEntity($departamento, $this->request->getData());
            if ($this->Departamentos->save($departamento)) {
                $this->Flash->success(__('El departamento ha sido guardado.'));
                $this->request->getSession()->delete('departamentoId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el departamento. Inténtelo de nuevo.'));
        }

        $paises = $this->Departamentos->Paises->find('list', ['keyField' => 'id', 'valueField' => 'pais', 'order' => ['pais' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('departamento', 'paises', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Departamentos', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $departamento = $this->Departamentos->get($id);
        if ($this->Departamentos->delete($departamento)) {
            $this->Flash->success(__('El departamento ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el departamento. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Departamentos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $departamento = $this->Departamentos->get($id);
        $departamento->estado = 0; // Cambia el estado a inactivo
        $departamento->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Departamentos->save($departamento)) {
            $this->Flash->success(__('El departamento ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el departamento. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Departamentos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $departamento = $this->Departamentos->get($id);
        $departamento->estado = 1; // Cambia el estado a activo
        $departamento->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Departamentos->save($departamento)) {
            $this->Flash->success(__('El departamento ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el departamento. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerDepartamento method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verDepartamento($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('departamentoId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarDepartamento method
     *
     * @param string|null $id Departamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarDepartamento($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('departamentoId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
