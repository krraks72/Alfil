<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Filas Controller
 *
 * @property \App\Model\Table\FilasTable $Filas
 * @method \App\Model\Entity\Fila[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilasController extends AppController
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

        if (!HelperController::verificarPermiso('Filas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('filaId');

        $this->paginate = ['contain' => ['Generos', 'Prioridades'],];
        $filas = $this->paginate($this->Filas);

        $this->set(compact('filas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Filas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('filaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('filaId');

        $fila = $this->Filas->get($id, ['contain' => ['Generos', 'Prioridades'],]);

        $this->set(compact('fila', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Filas', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $fila = $this->Filas->newEmptyEntity();
        if ($this->request->is('post')) {
            $fila = $this->Filas->patchEntity($fila, $this->request->getData());
            $fila->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Filas->save($fila)) {
                $this->Flash->success(__('La fila ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la fila. Inténtelo de nuevo.'));
        }
        
        $generos = $this->Filas->Generos->find('list', ['keyField' => 'id', 'valueField' => 'genero', 'order' => ['genero' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $prioridades = $this->Filas->Prioridades->find('list', ['keyField' => 'id', 'valueField' => 'prioridad', 'order' => ['prioridad' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('fila', 'generos', 'prioridades', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Filas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('filaId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $fila = $this->Filas->get($id, ['contain' => ['Generos', 'Prioridades'],]);
        $fila->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $fila = $this->Filas->patchEntity($fila, $this->request->getData());
            if ($this->Filas->save($fila)) {
                $this->Flash->success(__('La fila ha sido guardada.'));
                $this->request->getSession()->delete('filaId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la fila. Inténtelo de nuevo.'));
        }

        $generos = $this->Filas->Generos->find('list', ['keyField' => 'id', 'valueField' => 'genero', 'order' => ['genero' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $prioridades = $this->Filas->Prioridades->find('list', ['keyField' => 'id', 'valueField' => 'prioridad', 'order' => ['prioridad' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('fila', 'generos', 'prioridades', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Filas', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $fila = $this->Filas->get($id);
        if ($this->Filas->delete($fila)) {
            $this->Flash->success(__('La fila ha sido eliminar.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la fila. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Filas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $fila = $this->Filas->get($id);
        $fila->estado = 0; // Cambia el estado a inactivo
        $fila->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Filas->save($fila)) {
            $this->Flash->success(__('La fila ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la fila. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Filas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $fila = $this->Filas->get($id);
        $fila->estado = 1; // Cambia el estado a activo
        $fila->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Filas->save($fila)) {
            $this->Flash->success(__('La fila ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la fila. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerFila method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verFila($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('filaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarFila method
     *
     * @param string|null $id Fila id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarFila($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('filaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
