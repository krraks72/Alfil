<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Filasventanillas Controller
 *
 * @property \App\Model\Table\FilasventanillasTable $Filasventanillas
 * @method \App\Model\Entity\Filasventanilla[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilasventanillasController extends AppController
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

        if (!HelperController::verificarPermiso('Filasventanillas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('filasVentanillaId');

        $this->paginate = ['contain' => ['Filas', 'Ventanillas'],];
        $filasventanillas = $this->paginate($this->Filasventanillas);

        $this->set(compact('filasventanillas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Filasventanillas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('filasventanillaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('filasventanillaId');

        $filasventanilla = $this->Filasventanillas->get($id, ['contain' => ['Filas', 'Ventanillas'],]);
        
        $this->set(compact('filasventanilla', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Filasventanillas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $filasventanilla = $this->Filasventanillas->newEmptyEntity();
        if ($this->request->is('post')) {
            $filasventanilla = $this->Filasventanillas->patchEntity($filasventanilla, $this->request->getData());
            $filasventanilla->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Filasventanillas->save($filasventanilla)) {
                $this->Flash->success(__('La asociación Fila-Ventanilla ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la asociación Fila-Ventanilla. Inténtelo de nuevo.'));
        }
        
        $filas = $this->Filasventanillas->Filas->find('list', ['keyField' => 'id', 'valueField' => 'fila', 'order' => ['fila' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $ventanillas = $this->Filasventanillas->Ventanillas->find('list', ['keyField' => 'id', 'valueField' => 'ventanilla', 'order' => ['ventanilla' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('filasventanilla', 'filas', 'ventanillas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Filasventanillas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('filasventanillaId');

        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $filasventanilla = $this->Filasventanillas->get($id, ['contain' => ['Filas', 'Ventanillas'],]);
        $filasventanilla->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $filasventanilla = $this->Filasventanillas->patchEntity($filasventanilla, $this->request->getData());
            if ($this->Filasventanillas->save($filasventanilla)) {
                $this->Flash->success(__('La asociación Fila-Ventanilla ha sido guardada.'));
                $this->request->getSession()->delete('filasventanillaId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la asociación Fila-Ventanilla. Inténtelo de nuevo.'));
        }        
        
        $filas = $this->Filasventanillas->Filas->find('list', ['keyField' => 'id', 'valueField' => 'fila', 'order' => ['fila' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $ventanillas = $this->Filasventanillas->Ventanillas->find('list', ['keyField' => 'id', 'valueField' => 'ventanilla', 'order' => ['ventanilla' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('filasventanilla', 'filas', 'ventanillas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Filasventanillas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $filasventanilla = $this->Filasventanillas->get($id);
        if ($this->Filasventanillas->delete($filasventanilla)) {
            $this->Flash->success(__('La asociación Fila-Ventanilla ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo guardar la asociación Fila-Ventanilla. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Filasventanillas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $filasventanilla = $this->Filasventanillas->get($id);
        $filasventanilla->estado = 0; // Cambia el estado a inactivo
        $filasventanilla->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Filasventanillas->save($filasventanilla)) {
            $this->Flash->success(__('La asociación Fila-Ventanilla ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la asociación Fila-Ventanilla. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Filasventanillas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $filasventanilla = $this->Filasventanillas->get($id);
        $filasventanilla->estado = 1; // Cambia el estado a activo
        $filasventanilla->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Filasventanillas->save($filasventanilla)) {
            $this->Flash->success(__('La asociación Fila-Ventanilla ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la asociación Fila-Ventanilla. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerFilasventanilla method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verFilasventanilla($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('filasventanillaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarFilasventanilla method
     *
     * @param string|null $id Filasventanilla id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarFilasventanilla($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('filasventanillaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
