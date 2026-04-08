<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Generos Controller
 *
 * @property \App\Model\Table\GenerosTable $Generos
 * @method \App\Model\Entity\Genero[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GenerosController extends AppController
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

        if (!HelperController::verificarPermiso('Generos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }
        
        $this->request->getSession()->delete('generoId');

        $generos = $this->paginate($this->Generos);

        $this->set(compact('generos', 'cachePermisos', 'permisosArray'));
    }

    /**
     * View method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Generos', 'leer')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('generoId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }
        
        $this->request->getSession()->delete('generoId');

        $genero = $this->Generos->get($id, ['contain' => ['Filas'],]);

        $this->set(compact('genero', 'cachePermisos', 'permisosArray'));
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

        if (!HelperController::verificarPermiso('Generos', 'crear')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $genero = $this->Generos->newEmptyEntity();
        if ($this->request->is('post')) {
            $genero = $this->Generos->patchEntity($genero, $this->request->getData());
            $genero->usuarioCrea = HelperController::obtenerUsuario();
            if ($this->Generos->save($genero)) {
                $this->Flash->success(__('El género ha sido creado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el género. Inténtelo de nuevo.'));
        }
        $this->set(compact('genero', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $cachePermisos = HelperController::obtenerPermisosUsuario();
        $permisosArray = HelperController::obtenerArrayPermiso(); 

        if (!HelperController::verificarPermiso('Generos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $id = $this->request->getSession()->read('generoId');
        if (!$id) {
            $this->Flash->error(__('ID no disponible.'));
            return $this->redirect(['action' => 'index']);
        }

        $genero = $this->Generos->get($id, ['contain' => ['Filas'],]);
        $genero->usuarioMod = HelperController::obtenerUsuario();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $genero = $this->Generos->patchEntity($genero, $this->request->getData());
            if ($this->Generos->save($genero)) {
                $this->Flash->success(__('El género ha sido guardado.'));
                $this->request->getSession()->delete('generoId');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el género. Inténtelo de nuevo.'));
        }
        $this->set(compact('genero', 'cachePermisos', 'permisosArray'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!HelperController::verificarPermiso('Generos', 'eliminar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $genero = $this->Generos->get($id);
        if ($this->Generos->delete($genero)) {
            $this->Flash->success(__('El género ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminado el género. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Inactivar method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function inactivar($id = null)
    {
        if (!HelperController::verificarPermiso('Generos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $genero = $this->Generos->get($id);
        $genero->estado = 0; // Cambia el estado a inactivo
        $genero->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Generos->save($genero)) {
            $this->Flash->success(__('El género ha sido inactivado.'));
        } else {
            $this->Flash->error(__('No se pudo inactivar el género. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Activar method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */     
    public function activar($id = null)
    {
        if (!HelperController::verificarPermiso('Generos', 'editar')) {
            return $this->redirect(['controller' => 'Home', 'action' => 'index']);
        }

        $this->request->allowMethod(['post', 'put']);

        $genero = $this->Generos->get($id);
        $genero->estado = 1; // Cambia el estado a activo
        $genero ->usuarioMod = HelperController::obtenerUsuario();

        if ($this->Generos->save($genero)) {
            $this->Flash->success(__('El género ha sido activado.'));
        } else {
            $this->Flash->error(__('No se pudo activar el género. Inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * VerGenero method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function verGenero($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('generoId', $id);
        return $this->redirect(['action' => 'view']);
    }

    /**
     * EditarGenero method
     *
     * @param string|null $id Genero id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editarGenero($id = null)
    {
        $this->request->allowMethod(['post']);
        $this->request->getSession()->write('generoId', $id);
        return $this->redirect(['action' => 'edit']);
    }
}
