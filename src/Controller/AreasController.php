<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Areas Controller
 *
 * @property \App\Model\Table\AreasTable $Areas
 * @method \App\Model\Entity\Area[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AreasController extends AppController
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

        if (!HelperController::verificarPermiso('Areas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->getSession()->delete('areaId');

        $this->paginate = ['contain' => ['Ipss'],];

        $areas = $this->paginate($this->Areas);

        $this->set(compact('areas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso();
        
        if (!HelperController::verificarPermiso('Areas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('areaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $area = $this->Areas->get($id, ['contain' => ['Ipss'],]);

        $this->set(compact('area', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Areas', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $area = $this->Areas->newEmptyEntity();
        if ($this->request->is('post')) {
            $area = $this->Areas->patchEntity($area, $this->request->getData());
            $area->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Areas->save($area)) {
                $this->Flash->success(__('El área ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el área. Inténtelo de nuevo.'));
        }

        $ipss = $this->Areas->Ipss->find('list',  ['keyField' => 'id', 'valueField' => 'ips', 'order' => ['ips' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('area', 'ipss', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso();

        if (!HelperController::verificarPermiso('Areas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('areaId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $area = $this->Areas->get($id, ['contain' => ['Ipss'],]);
        $area->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $area = $this->Areas->patchEntity($area, $this->request->getData());
            if ($this->Areas->save($area)) {
                $this->Flash->success(__('El área ha sido guardada.'));
                $this->request->getSession()->delete('areaId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el área. Inténtelo de nuevo.'));
        }
        
        $ipss = $this->Areas->Ipss->find('list',  ['keyField' => 'id', 'valueField' => 'ips', 'order' => ['ips' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('area', 'ipss', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Areas', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $area = $this->Areas->get($id);
        if ($this->Areas->delete($area)) {
            $this->Flash->success(__('El área ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el área. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Areas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $area = $this->Areas->get($id);
        $area->estado = 0; // Cambia el estado a inactivo
        $area->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Areas->save($area)) {
            $this->Flash->success(__('El área ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el área. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Areas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $area = $this->Areas->get($id);
        $area->estado = 1; // Cambia el estado a activo
        $area->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Areas->save($area)) {
            $this->Flash->success(__('El área ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar el área. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerArea method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verArea($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('areaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarArea method
     *
     * @param string|null $id Area id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarArea($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('areaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
