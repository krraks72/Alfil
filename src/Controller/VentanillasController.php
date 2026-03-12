<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ventanillas Controller
 *
 * @property \App\Model\Table\VentanillasTable $Ventanillas
 * @method \App\Model\Entity\Ventanilla[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VentanillasController extends AppController
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

        if (!HelperController::verificarPermiso('Ventanillas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('ventanillaId');
    
        $this->paginate = ['contain' => ['Salas','Sedes','Areas'],];

        $ventanillas = $this->paginate($this->Ventanillas);

        $this->set(compact('ventanillas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Ventanillas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('ventanillaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->request->getSession()->delete('ventanillaId');

        $ventanilla = $this->Ventanillas->get($id, ['contain' => ['Salas','Sedes','Areas'],]);

        $this->set(compact('ventanilla', 'cachePermisos', 'permisosArray'));
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

        $ventanilla = $this->Ventanillas->newEmptyEntity();
        if ($this->request->is('post')) {
            $ventanilla = $this->Ventanillas->patchEntity($ventanilla, $this->request->getData());
            $ventanilla->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Ventanillas->save($ventanilla)) {
                $this->Flash->success(__('La ventanilla ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la ventanilla. Inténtelo de nuevo.'));
        }

        $sedes = $this->Ventanillas->Sedes->find('list',  ['keyField' => 'id', 'valueField' => 'sede', 'order' => ['sede' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $salas = $this->Ventanillas->Salas->find('list',  ['keyField' => 'id', 'valueField' => 'sala', 'order' => ['sala' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $areas = $this->Ventanillas->Areas->find('list',  ['keyField' => 'id', 'valueField' => 'area', 'order' => ['area' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('ventanilla', 'cachePermisos', 'permisosArray', 'areas', 'sedes', 'salas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Ventanillas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('ventanillaId');
        
        $ventanilla = $this->Ventanillas->get($id, ['contain' => ['Salas','Sedes','Areas'],]);
        $ventanilla->usuarioMod = HelperController::obtenerUsuario();
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ventanilla = $this->Ventanillas->patchEntity($ventanilla, $this->request->getData());
            if ($this->Ventanillas->save($ventanilla)) {
                $this->Flash->success(__('La ventanilla ha sido guardada.'));
                $this->request->getSession()->delete('sedeId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la ventanilla. Inténtelo de nuevo.'));
        }
        
        $sedes = $this->Ventanillas->Sedes->find('list',  ['keyField' => 'id', 'valueField' => 'sede', 'order' => ['sede' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $salas = $this->Ventanillas->Salas->find('list',  ['keyField' => 'id', 'valueField' => 'sala', 'order' => ['sala' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $areas = $this->Ventanillas->Areas->find('list',  ['keyField' => 'id', 'valueField' => 'area', 'order' => ['area' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('ventanilla', 'cachePermisos', 'permisosArray', 'areas', 'sedes', 'salas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Ventanillas', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $ventanilla = $this->Ventanillas->get($id);
        if ($this->Ventanillas->delete($ventanilla)) {
            $this->Flash->success(__('La ventanilla ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la ventanilla. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Ventanillas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $ventanilla = $this->Ventanillas->get($id);
        $ventanilla->estado = 0; // Cambia el estado a inactivo
        $ventanilla->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Ventanillas->save($ventanilla)) {
            $this->Flash->success(__('La ventanilla ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la ventanilla. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Ventanillas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $ventanilla = $this->Ventanillas->get($id);
        $ventanilla->estado = 1; // Cambia el estado a activo
        $ventanilla->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Ventanillas->save($ventanilla)) {
            $this->Flash->success(__('La ventanilla ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la ventanilla. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerVentanilla method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verVentanilla($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('ventanillaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarVentanilla method
     *
     * @param string|null $id Ventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarVentanilla($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('ventanillaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
