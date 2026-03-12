<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Sedes Controller
 *
 * @property \App\Model\Table\SedesTable $Sedes
 * @method \App\Model\Entity\Sede[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SedesController extends AppController
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

        if (!HelperController::verificarPermiso('Sedes', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('sedeId');

        $this->paginate = ['contain' => ['Municipios','Ipss'],];

        $sedes = $this->paginate($this->Sedes);

        $this->set(compact('sedes', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Sedes', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('sedeId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('sedeId');

        $sede = $this->Sedes->get($id, ['contain' => ['Municipios','Ipss'],]);

        $this->set(compact('sede', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Sedes', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $sede = $this->Sedes->newEmptyEntity();
        if ($this->request->is('post')) {
            $sede = $this->Sedes->patchEntity($sede, $this->request->getData());
            $sede->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Sedes->save($sede)) {
                $this->Flash->success(__('La sede ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la sede. Inténtelo de nuevo.'));
        }
        
        $municipios = $this->Sedes->Municipios->find('list', ['keyField' => 'id', 'valueField' => 'municipio', 'order' => ['municipio' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $ipss = $this->Sedes->Ipss->find('list', ['keyField' => 'id', 'valueField' => 'ips', 'order' => ['ips' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('sede', 'municipios', 'ipss', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Sedes', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('sedeId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $sede = $this->Sedes->get($id, ['contain' => ['Municipios','Ipss'],]);
        $sede->usuarioMod = HelperController::obtenerUsuario();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sede = $this->Sedes->patchEntity($sede, $this->request->getData());
            if ($this->Sedes->save($sede)) {
                $this->Flash->success(__('La sede ha sido guardada.'));
                $this->request->getSession()->delete('sedeId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la sede. Inténtelo de nuevo.'));
        }
        
        $municipios = $this->Sedes->Municipios->find('list', ['keyField' => 'id', 'valueField' => 'municipio', 'order' => ['municipio' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $ipss = $this->Sedes->Ipss->find('list', ['keyField' => 'id', 'valueField' => 'ips', 'order' => ['ips' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('sede', 'municipios', 'ipss', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Sedes', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $sede = $this->Sedes->get($id);
        if ($this->Sedes->delete($sede)) {
            $this->Flash->success(__('La sede ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la sede. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Sedes', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $sede = $this->Sedes->get($id);
        $sede->estado = 0; // Cambia el estado a inactivo
        $sede->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Sedes->save($sede)) {
            $this->Flash->success(__('La sede ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la sede. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Sedes', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $sede = $this->Sedes->get($id);
        $sede->estado = 1; // Cambia el estado a activo
        $sede->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Sedes->save($sede)) {
            $this->Flash->success(__('La sede ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la sede. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerSede method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verSede($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('sedeId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarSede method
     *
     * @param string|null $id Sede id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarSede($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('sedeId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
