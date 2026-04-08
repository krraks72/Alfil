<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Salas Controller
 *
 * @property \App\Model\Table\SalasTable $Salas
 * @method \App\Model\Entity\Sala[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalasController extends AppController
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

        if (!HelperController::verificarPermiso('Salas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('salaId');
    
        $this->paginate = ['contain' => ['Sedes'],];

        $salas = $this->paginate($this->Salas);

        $this->set(compact('salas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Sala id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Salas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('salaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->request->getSession()->delete('salaId');

        $sala = $this->Salas->get($id, ['contain' => ['Sedes'],]);

        $this->set(compact('sala', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Salas', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $sala = $this->Salas->newEmptyEntity();
        if ($this->request->is('post')) {
            $sala = $this->Salas->patchEntity($sala, $this->request->getData());
            $sala->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Salas->save($sala)) {
                $this->Flash->success(__('La sala ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la sala. Inténtelo de nuevo.'));
        }
        
        $sedes = $this->Salas->Sedes->find('list', ['keyField' => 'id', 'valueField' => 'sede', 'order' => ['sede' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('sala', 'cachePermisos', 'permisosArray', 'sedes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sala id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Salas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('salaId');
        
        $sala = $this->Salas->get($id, ['contain' => ['Sedes'],]);
        $sala->usuarioMod = HelperController::obtenerUsuario();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sala = $this->Salas->patchEntity($sala, $this->request->getData());
            if ($this->Salas->save($sala)) {
                $this->Flash->success(__('La sala ha sido guardada.'));
                $this->request->getSession()->delete('salaId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la sala. Inténtelo de nuevo.'));
        }
        
        $sedes = $this->Salas->Sedes->find('list', ['keyField' => 'id', 'valueField' => 'sede', 'order' => ['sede' => 'ASC']])->where(['estado' => 1])->limit(200)->all();

        $this->set(compact('sala', 'cachePermisos', 'permisosArray', 'sedes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sala id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Salas', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $sala = $this->Salas->get($id);
        if ($this->Salas->delete($sala)) {
            $this->Flash->success(__('La sala ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la sala. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Sala id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Salas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $sala = $this->Salas->get($id);
        $sala->estado = 0; // Cambia el estado a inactivo
        $sala->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Salas->save($sala)) {
            $this->Flash->success(__('La sala ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la sala. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Sala id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Salas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $sala = $this->Salas->get($id);
        $sala->estado = 1; // Cambia el estado a activo
        $sala->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Ventanillas->save($sala)) {
            $this->Flash->success(__('La sala ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la sala. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerSala method
     *
     * @param string|null $id Sala id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verSala($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('salaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarSala method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarSala($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('salaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
