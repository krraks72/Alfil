<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Filasrutas Controller
 *
 * @property \App\Model\Table\FilasrutasTable $Filasrutas
 * @method \App\Model\Entity\Filasruta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilasrutasController extends AppController
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

        if (!HelperController::verificarPermiso('Filasrutas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('filasrutaId');

        $this->paginate = ['contain' => ['Filas', 'Rutas'],];
        $filasrutas = $this->paginate($this->Filasrutas);

        $this->set(compact('filasrutas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Filasrutas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('filasrutaId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('filasrutaId');

        $filasruta = $this->Filasrutas->get($id, ['contain' => ['Filas', 'Rutas'],]);
        
        $this->set(compact('filasruta', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Filasrutas', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $filasruta = $this->Filasrutas->newEmptyEntity();
        if ($this->request->is('post')) {
            $filasruta = $this->Filasrutas->patchEntity($filasruta, $this->request->getData());
            $filasruta->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Filasrutas->save($filasruta)) {
                $this->Flash->success(__('La asociación Fila-Ruta ha sido creada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear la asociación Fila-Ruta. Inténtelo de nuevo.'));
        }
        
        $filas = $this->Filasrutas->Filas->find('list', ['keyField' => 'id', 'valueField' => 'fila', 'order' => ['fila' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $rutas = $this->Filasrutas->Rutas->find('list', ['keyField' => 'id', 'valueField' => 'ruta', 'order' => ['ruta' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('filasruta', 'filas', 'rutas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Filasrutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('filasrutaId');
        
        if (!$id) {
            $this->Flash->error(__('Id no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $filasruta = $this->Filasrutas->get($id, ['contain' => ['Filas', 'Rutas'],]);
        $filasruta->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $filasruta = $this->Filasrutas->patchEntity($filasruta, $this->request->getData());
            if ($this->Filasrutas->save($filasruta)) {
                $this->Flash->success(__('La asociación Fila-Ruta ha sido guardada.'));
                $this->request->getSession()->delete('filasrutaId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la asociación Fila-Ruta. Inténtelo de nuevo.'));
        }
        
        $filas = $this->Filasrutas->Filas->find('list', ['keyField' => 'id', 'valueField' => 'fila', 'order' => ['fila' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        $rutas = $this->Filasrutas->Rutas->find('list', ['keyField' => 'id', 'valueField' => 'ruta', 'order' => ['ruta' => 'ASC']])->where(['estado' => 1])->limit(200)->all();
        
        $this->set(compact('filasruta', 'filas', 'rutas', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Filasrutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $filasruta = $this->Filasrutas->get($id);
        if ($this->Filasrutas->delete($filasruta)) {
            $this->Flash->success(__('La asociación Fila-Ruta ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la asociación Fila-Ruta. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Filasrutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $filasruta = $this->Filasrutas->get($id);
        $filasruta->estado = 0; // Cambia el estado a inactivo
        $filasruta->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Filasrutas->save($filasruta)) {
            $this->Flash->success(__('La asociación Fila-Ruta ha sido inactivada.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar la asociación Fila-Ruta. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Filasrutas', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $filasruta = $this->Filasrutas->get($id);
        $filasruta->estado = 1; // Cambia el estado a activo
        $filasruta->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Filasrutas->save($filasruta)) {
            $this->Flash->success(__('La asociación Fila-Ruta ha sido activada.'));
        } else {
            $this->Flash->error(__('No se pudo activar la asociación Fila-Ruta. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerFilasruta method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */    
    public function verFilasruta($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('filasrutaId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarFilasruta method
     *
     * @param string|null $id Filasruta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarFilasruta($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('filasrutaId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
