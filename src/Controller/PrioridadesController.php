<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Prioridades Controller
 *
 * @property \App\Model\Table\PrioridadesTable $Prioridades
 * @method \App\Model\Entity\Prioridade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrioridadesController extends AppController
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

        if (!HelperController::verificarPermiso('Prioridades', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('prioridadeId');

        $prioridades = $this->paginate($this->Prioridades);

        $this->set(compact('prioridades', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Prioridades', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('prioridadeId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('prioridadeId');

        $prioridade = $this->Prioridades->get($id, ['contain' => ['Filas'],]);

        $this->set(compact('prioridade', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Prioridades', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $prioridade = $this->Prioridades->newEmptyEntity();
        if ($this->request->is('post')) {
            $prioridade = $this->Prioridades->patchEntity($prioridade, $this->request->getData());
            $prioridade->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Prioridades->save($prioridade)) {
                $this->Flash->success(__('La prioridad ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la prioridad. Inténtelo de nuevo.'));
        }
        $this->set(compact('prioridade', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Prioridades', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('prioridadeId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $prioridade = $this->Prioridades->get($id, ['contain' => ['Filas'],]);
        $prioridade->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $prioridade = $this->Prioridades->patchEntity($prioridade, $this->request->getData());
            if ($this->Prioridades->save($prioridade)) {
                $this->Flash->success(__('La prioridad ha sido guardada.'));
                $this->request->getSession()->delete('paiseId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar La prioridad. Inténtelo de nuevo.'));
        }
        $this->set(compact('prioridade', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Prioridades', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $prioridade = $this->Prioridades->get($id);
        if ($this->Prioridades->delete($prioridade)) {
            $this->Flash->success(__('La prioridad ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar La prioridad. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Prioridades', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $prioridade = $this->Prioridades->get($id);
        $prioridade->estado = 0; // Cambia el estado a inactivo
        $prioridade->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Prioridades->save($prioridade)) {
            $this->Flash->success(__('La prioridad ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la prioridad. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Prioridades', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $prioridade = $this->Prioridades->get($id);
        $prioridade->estado = 1; // Cambia el estado a activo
        $prioridade->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Prioridades->save($prioridade)) {
            $this->Flash->success(__('La prioridad ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la prioridad. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerPrioridade method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verPrioridade($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('prioridadeId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarPrioridade method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarPrioridade($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('prioridadeId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
